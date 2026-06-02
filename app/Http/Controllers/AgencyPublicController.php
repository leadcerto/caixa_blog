<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\View\View;

class AgencyPublicController extends Controller
{
    /**
     * Exibe a página pública de uma agência (SEO Local).
     *
     * URL: /imoveis_caixa/{slug}
     * Title + H1: "Imóveis Caixa {Bairro} {Cidade} {Estado}"
     *
     * Carrega reviews com Eager Loading, ordenadas pelas mais recentes.
     */
    public function show(string $slug): View
    {
        $agency = Agency::query()
            ->where('slug', $slug)
            ->with(['reviews' => function ($query) {
                $query->orderByDesc('review_date')->limit(20);
            }])
            ->firstOrFail();

        // Agências próximas (mesma cidade, outro bairro) para link interno / SEO
        $nearbyAgencies = Agency::query()
            ->where('city', $agency->city)
            ->where('state', $agency->state)
            ->where('id', '!=', $agency->id)
            ->orderBy('neighborhood')
            ->limit(6)
            ->get();

        return view('agencies.show', compact('agency', 'nearbyAgencies'));
    }

    /**
     * Lista todas as agências (página índice para SEO).
     *
     * URL: /imoveis_caixa
     */
    public function index(): View
    {
        $agencies = Agency::query()
            ->orderBy('neighborhood')
            ->orderBy('name')
            ->paginate(24);

        // Agrupamento por bairro para exibição organizada
        $neighborhoods = Agency::query()
            ->select('neighborhood')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('neighborhood')
            ->orderBy('neighborhood')
            ->get();

        return view('agencies.index', compact('agencies', 'neighborhoods'));
    }
}
