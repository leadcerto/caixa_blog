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

    public function test_manual_page_uses_image_whatsapp_button_not_default_pill(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertDontSee('Atendimento Rápido');
        $response->assertSee('botao-whatsapp.svg', false);
        $response->assertSee('wa.me/5521997882950', false);
    }

    public function test_manual_page_has_accordion_chevron_css(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('details[open] .chevron', false);
    }

    public function test_manual_page_renders_first_five_sections(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $response->assertSee('id="manual-1"', false);
        $response->assertSee('O Portal de Venda de Imóveis CAIXA');
        $response->assertSee('Modalidades de Venda');
        $response->assertSee('Como Encontrar Seu Imóvel');
        $response->assertSee('Cadastro e Envio da Proposta');
        $response->assertSee('Consultando Suas Propostas');
        $this->assertSame(15, substr_count($content, '<details id="manual-'));
        $this->assertSame(15, substr_count($content, 'href="#manual-'));
    }

    public function test_manual_page_renders_sections_six_to_ten(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $response->assertSee('id="manual-10"', false);
        $response->assertSee('Alterando Sua Proposta');
        $response->assertSee('Próximos Passos Após a Compra');
        $response->assertSee('Visita e Situação do Imóvel');
        $response->assertSee('Desocupação do Imóvel');
        $response->assertSee('Formas de Pagamento Aceitas');
        $this->assertSame(15, substr_count($content, '<details id="manual-'));
        $this->assertSame(15, substr_count($content, 'href="#manual-'));
    }

    public function test_manual_page_renders_all_fifteen_sections(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $response->assertSee('id="manual-15"', false);
        $response->assertSee('Financiamento Imobiliário — Requisitos e Documentos');
        $response->assertSee('Despesas de Compra');
        $response->assertSee('Regras de Despesas de Condomínio');
        $response->assertSee('Despesas de Tributos e IPTU');
        $response->assertSee('Prazos Importantes (Resumo)');
        $response->assertSee('Liminar de desocupação judicial: possibilidade de 60 dias.');
        $this->assertSame(15, substr_count($content, '<details id="manual-'));
        $this->assertSame(15, substr_count($content, 'href="#manual-'));
    }

    public function test_manual_page_has_lead_form_with_correct_page_name(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('Cadastro de Interesse de Compra');
        $response->assertSee('name="page_name" value="Manual de Compra dos Imóveis da CAIXA"', false);
        $response->assertSee('action="' . route('contato.store') . '"', false);
    }

    public function test_manual_page_links_to_venda_imoveis_guide(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('href="' . route('venda.imoveis') . '"', false);
    }
}
