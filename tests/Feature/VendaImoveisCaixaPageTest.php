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
}
