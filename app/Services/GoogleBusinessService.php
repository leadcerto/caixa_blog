<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Integração com Google Business Profile API (My Business API v4 / Business Information API v1).
 *
 * Pré-requisitos (Google Cloud Console):
 *   1. Criar projeto e habilitar "Business Profile API"
 *   2. Criar credenciais OAuth 2.0 (tipo "Web application")
 *   3. Usar o OAuth Playground para gerar o refresh_token com o escopo:
 *      https://www.googleapis.com/auth/business.manage
 *   4. Preencher as variáveis no .env:
 *      GOOGLE_BUSINESS_CLIENT_ID, GOOGLE_BUSINESS_CLIENT_SECRET,
 *      GOOGLE_BUSINESS_REFRESH_TOKEN, GOOGLE_BUSINESS_ACCOUNT_ID
 */
class GoogleBusinessService
{
    private const TOKEN_URL    = 'https://oauth2.googleapis.com/token';
    private const REVIEWS_BASE = 'https://mybusiness.googleapis.com/v4';
    private const TOKEN_CACHE  = 'gmb_access_token';

    private function isConfigured(): bool
    {
        return filled(config('services.google_business.client_id'))
            && filled(config('services.google_business.client_secret'))
            && filled(config('services.google_business.refresh_token'));
    }

    /**
     * Troca o refresh_token por um access_token válido por 1 hora.
     * Resultado é cacheado para evitar chamadas desnecessárias ao token endpoint.
     */
    private function getAccessToken(): ?string
    {
        if (! $this->isConfigured()) {
            Log::warning('GoogleBusinessService: credenciais OAuth não configuradas no .env.');
            return null;
        }

        return Cache::remember(self::TOKEN_CACHE, 3500, function () {
            $response = Http::asForm()->post(self::TOKEN_URL, [
                'client_id'     => config('services.google_business.client_id'),
                'client_secret' => config('services.google_business.client_secret'),
                'refresh_token' => config('services.google_business.refresh_token'),
                'grant_type'    => 'refresh_token',
            ]);

            if (! $response->successful()) {
                Log::error('GoogleBusinessService: falha ao obter access_token.', [
                    'status'   => $response->status(),
                    'response' => $response->json(),
                ]);
                return null;
            }

            return $response->json('access_token');
        });
    }

    /**
     * Busca todas as avaliações de um local no Google Business Profile.
     * Lida com paginação automaticamente (máx. 50 por página).
     *
     * @param  string  $googleLocationId  Ex: "accounts/{accountId}/locations/{locationId}"
     * @return array   Lista de reviews com campos da API (reviewId, reviewer, starRating, comment, createTime)
     */
    public function fetchReviews(string $googleLocationId): array
    {
        $token = $this->getAccessToken();

        if (! $token) {
            return [];
        }

        $reviews   = [];
        $pageToken = null;

        do {
            $params = ['pageSize' => 50, 'orderBy' => 'updateTime desc'];

            if ($pageToken) {
                $params['pageToken'] = $pageToken;
            }

            $response = Http::withToken($token)
                ->get(self::REVIEWS_BASE . "/{$googleLocationId}/reviews", $params);

            if (! $response->successful()) {
                Log::error('GoogleBusinessService: erro ao buscar reviews.', [
                    'location' => $googleLocationId,
                    'status'   => $response->status(),
                    'response' => $response->json(),
                ]);
                break;
            }

            $data      = $response->json();
            $reviews   = array_merge($reviews, $data['reviews'] ?? []);
            $pageToken = $data['nextPageToken'] ?? null;

        } while ($pageToken);

        return $reviews;
    }

    /**
     * Envia uma resposta do administrador a uma avaliação do Google.
     *
     * @param  string  $googleReviewId  Caminho completo da review (accounts/.../locations/.../reviews/{id})
     * @param  string  $replyText       Texto da resposta
     * @return bool
     */
    public function replyToReview(string $googleReviewId, string $replyText): bool
    {
        $token = $this->getAccessToken();

        if (! $token) {
            return false;
        }

        $response = Http::withToken($token)
            ->put(self::REVIEWS_BASE . "/{$googleReviewId}/reply", [
                'comment' => $replyText,
            ]);

        if (! $response->successful()) {
            Log::error('GoogleBusinessService: erro ao enviar resposta.', [
                'review'   => $googleReviewId,
                'status'   => $response->status(),
                'response' => $response->json(),
            ]);
            return false;
        }

        return true;
    }
}
