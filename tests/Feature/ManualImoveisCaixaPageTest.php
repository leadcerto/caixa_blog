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

    public function test_manual_page_has_howto_json_ld(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $response->getContent(), $matches);
        $this->assertNotEmpty($matches, 'JSON-LD script tag not found on manual page');

        $json = json_decode($matches[1], true);

        $this->assertSame('HowTo', $json['@type']);
        $this->assertSame('Manual de Compra dos Imóveis da CAIXA', $json['name']);
        $this->assertCount(15, $json['step']);
        $this->assertSame('HowToStep', $json['step'][0]['@type']);
        $this->assertSame('O Portal de Venda de Imóveis CAIXA', $json['step'][0]['name']);
    }

    public function test_manual_page_footer_has_manual_de_compra_link(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('Manual de Compra');
    }

    public function test_manual_page_includes_merged_venda_content(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('Descontos Agressivos');
        $response->assertSee('Perguntas Frequentes');
        $response->assertSee('Débitos Pós-Venda', false);
        $response->assertSee('Guia Completo de Compra');
        $response->assertSee('Modalidades de Venda');
        $response->assertSee('Assessoria Gratuita — Corretor Credenciado CAIXA', false);
        $response->assertSee('Leonardo Leão');
    }

    public function test_manual_page_has_enriched_hero_with_venda_subtitle_and_second_cta(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('até 70% de desconto', false);
        $response->assertSee('Quero ser atendido gratuitamente');
        $response->assertSee('href="#cadastro"', false);
    }

    public function test_manual_page_has_treinamento_cta(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('Quer lucrar com Flipping Imobiliário?');
        $response->assertSee('Ver o Treinamento');
    }

    public function test_manual_page_has_exactly_one_lead_form_and_no_self_referential_cross_links(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $this->assertSame(1, substr_count($content, 'id="cadastro"'));
        $response->assertSee('Este manual tem caráter informativo', false);
        $response->assertDontSee('Já decidiu comprar?');
        $response->assertDontSee('Quer entender por que vale a pena comprar um imóvel CAIXA?');
    }
}
