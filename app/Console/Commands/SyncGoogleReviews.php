<?php

namespace App\Console\Commands;

use App\Models\Agency;
use App\Models\Review;
use App\Services\GoogleBusinessService;
use Illuminate\Console\Command;

class SyncGoogleReviews extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'google:sync-reviews
                            {--agency= : ID específico de uma agência (opcional)}';

    /**
     * The console command description.
     */
    protected $description = 'Sincroniza avaliações do Google Business Profile para as agências cadastradas';

    public function __construct(
        private GoogleBusinessService $googleService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $query = Agency::query()->whereNotNull('google_location_id');

        if ($agencyId = $this->option('agency')) {
            $query->where('id', $agencyId);
        }

        $agencies = $query->get();

        if ($agencies->isEmpty()) {
            $this->warn('Nenhuma agência com google_location_id encontrada.');
            return self::SUCCESS;
        }

        $this->info("Sincronizando reviews de {$agencies->count()} agência(s)...");
        $bar = $this->output->createProgressBar($agencies->count());

        $totalNew = 0;

        foreach ($agencies as $agency) {
            $reviews = $this->googleService->fetchReviews($agency->google_location_id);

            foreach ($reviews as $reviewData) {
                // Upsert: cria se não existir, atualiza se já existir
                $review = Review::updateOrCreate(
                    ['google_review_id' => $reviewData['reviewId'] ?? $reviewData['name'] ?? ''],
                    [
                        'agency_id'     => $agency->id,
                        'reviewer_name' => $reviewData['reviewer']['displayName'] ?? 'Anônimo',
                        'rating'        => $this->parseStarRating($reviewData['starRating'] ?? 'FIVE'),
                        'comment'       => $reviewData['comment'] ?? null,
                        'review_date'   => isset($reviewData['createTime'])
                            ? \Carbon\Carbon::parse($reviewData['createTime'])
                            : now(),
                    ]
                );

                if ($review->wasRecentlyCreated) {
                    $totalNew++;
                }
            }

            // Recalcula a nota média da agência
            $avgRating = $agency->reviews()->avg('rating');
            $agency->update(['average_rating' => $avgRating]);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("✓ Sincronização concluída. {$totalNew} novas avaliações importadas.");

        return self::SUCCESS;
    }

    /**
     * Converte o enum de estrelas do Google para inteiro.
     */
    private function parseStarRating(string $starRating): int
    {
        return match ($starRating) {
            'ONE'   => 1,
            'TWO'   => 2,
            'THREE' => 3,
            'FOUR'  => 4,
            'FIVE'  => 5,
            default => 5,
        };
    }
}
