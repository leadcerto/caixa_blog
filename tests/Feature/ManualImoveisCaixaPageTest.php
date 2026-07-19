<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManualImoveisCaixaPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_manual_page_loads_successfully(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertStatus(200);
        $response->assertSee('Manual de Compra dos Imóveis da CAIXA');
    }

    public function test_manual_route_name_resolves_to_expected_path(): void
    {
        $this->assertSame('/manual-imoveis-caixa', route('manual.imoveis', [], false));
    }

    public function test_manual_page_has_busca_de_imoveis_button(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('https://venda.imoveisdacaixa.com.br/', false);
        $response->assertSee('Busca de Imóveis');
    }
}
