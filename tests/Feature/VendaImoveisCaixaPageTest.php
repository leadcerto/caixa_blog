<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendaImoveisCaixaPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_venda_imoveis_page_loads_successfully(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertStatus(200);
    }

    public function test_venda_imoveis_page_keeps_default_whatsapp_pill_button(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('Atendimento Rápido');
        $response->assertSee('wa.me/5521997882950', false);
    }

    public function test_venda_imoveis_page_has_accordion_css_exactly_once(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $this->assertSame(1, substr_count($response->getContent(), 'details[open] .chevron'));
    }

    public function test_venda_imoveis_page_still_has_lead_form_with_correct_page_name(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('Cadastro de Interesse de Compra');
        $response->assertSee('name="page_name" value="Venda de Imóveis da CAIXA"', false);
        $response->assertSee('action="' . route('contato.store') . '"', false);
    }

    public function test_venda_imoveis_page_links_to_manual_guide(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('href="' . route('manual.imoveis') . '"', false);
    }
}
