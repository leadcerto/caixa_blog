<?php

namespace Tests\Feature;

use Tests\TestCase;

class VendaImoveisCaixaRedirectTest extends TestCase
{
    public function test_old_venda_imoveis_caixa_url_redirects_permanently_to_manual_page(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertRedirect('/manual-imoveis-caixa');
        $response->assertStatus(301);
    }
}
