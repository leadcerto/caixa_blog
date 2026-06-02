<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Review;
use App\Services\GoogleBusinessService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AgencyController extends Controller
{
    // ─── CRUD de Agências ───────────────────────────────────────────────

    /**
     * Lista todas as agências no painel admin.
     */
    public function index(): View
    {
        $agencies = Agency::query()
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(25);

        return view('admin.agencies.index', compact('agencies'));
    }

    /**
     * Formulário de criação de agência.
     */
    public function create(): View
    {
        return view('admin.agencies.create');
    }

    /**
     * Salva nova agência.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'address'            => 'required|string|max:500',
            'neighborhood'       => 'required|string|max:100',
            'city'               => 'required|string|max:100',
            'state'              => 'required|string|size:2',
            'zip_code'           => 'nullable|string|max:10',
            'phone'              => 'nullable|string|max:20',
            'agency_number'      => 'required|string|max:20',
            'opening_hours'      => 'nullable|string|max:255',
            'google_location_id' => 'nullable|string|max:255',
        ]);

        // Gera slug SEO: {bairro}-{cidade}-{estado}
        $baseSlug = Str::slug("{$validated['neighborhood']}-{$validated['city']}-{$validated['state']}");
        $validated['slug'] = $this->generateUniqueSlug($baseSlug);

        Agency::create($validated);

        return redirect()->route('admin.agencies.index')
            ->with('success', 'Agência cadastrada com sucesso.');
    }

    /**
     * Formulário de edição de agência.
     */
    public function edit(Agency $agency): View
    {
        return view('admin.agencies.edit', compact('agency'));
    }

    /**
     * Atualiza agência existente.
     */
    public function update(Request $request, Agency $agency): RedirectResponse
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'address'            => 'required|string|max:500',
            'neighborhood'       => 'required|string|max:100',
            'city'               => 'required|string|max:100',
            'state'              => 'required|string|size:2',
            'zip_code'           => 'nullable|string|max:10',
            'phone'              => 'nullable|string|max:20',
            'agency_number'      => 'required|string|max:20',
            'opening_hours'      => 'nullable|string|max:255',
            'google_location_id' => 'nullable|string|max:255',
        ]);

        $agency->update($validated);

        return redirect()->route('admin.agencies.index')
            ->with('success', 'Agência atualizada com sucesso.');
    }

    /**
     * Remove agência (soft delete).
     */
    public function destroy(Agency $agency): RedirectResponse
    {
        $agency->delete();

        return redirect()->route('admin.agencies.index')
            ->with('success', 'Agência removida com sucesso.');
    }

    // ─── Gestão de Reviews ──────────────────────────────────────────────

    /**
     * Lista as reviews de uma agência com formulário de resposta.
     */
    public function reviews(Agency $agency): View
    {
        $agency->load(['reviews' => function ($query) {
            $query->orderByDesc('review_date');
        }]);

        return view('admin.agencies.reviews', compact('agency'));
    }

    /**
     * Salva a resposta do admin a uma review e envia para o Google.
     */
    public function replyToReview(
        Request $request,
        Agency $agency,
        Review $review,
        GoogleBusinessService $googleService
    ): RedirectResponse {
        $validated = $request->validate([
            'reply' => 'required|string|max:4096',
        ]);

        // Tenta enviar para o Google (se tiver google_review_id)
        if ($review->google_review_id) {
            $googleService->replyToReview($review->google_review_id, $validated['reply']);
        }

        // Salva a resposta localmente
        $review->update(['reply' => $validated['reply']]);

        return redirect()->route('admin.agencies.reviews', $agency)
            ->with('success', 'Resposta enviada com sucesso.');
    }

    // ─── Helpers ────────────────────────────────────────────────────────

    /**
     * Gera slug único, adicionando sufixo numérico se necessário.
     */
    private function generateUniqueSlug(string $baseSlug): string
    {
        $slug = $baseSlug;
        $counter = 1;

        while (Agency::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
