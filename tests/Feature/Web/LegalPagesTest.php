<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    public function test_privacy_policy_page_is_available_from_footer(): void
    {
        $response = $this->get(route('legal.privacy'));

        $response->assertOk();
        $response->assertSee('Política de Privacidade');
        $response->assertSee('Regulamento Geral sobre a Proteção de Dados');
        $response->assertSee('Comissão Nacional de Proteção de Dados');
        $response->assertSee('https://www.nbtech.pt/contacto');
        $response->assertDontSee('modelo informativo');
    }

    public function test_terms_and_conditions_page_is_available_from_footer(): void
    {
        $response = $this->get(route('legal.terms'));

        $response->assertOk();
        $response->assertSee('Termos e Condições');
        $response->assertSee('lei portuguesa');
        $response->assertSee('resolução alternativa de litígios');
        $response->assertSee('https://www.nbtech.pt/contacto');
        $response->assertDontSee('modelo informativo');
    }

    public function test_cookie_policy_page_is_available_from_footer(): void
    {
        $response = $this->get(route('legal.cookies'));

        $response->assertOk();
        $response->assertSee('Política de Cookies');
        $response->assertSee('cookies estritamente necessários');
        $response->assertSee('https://www.nbtech.pt/contacto');
    }

    public function test_footer_contains_required_legal_links(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee(route('legal.privacy'));
        $response->assertSee(route('legal.cookies'));
        $response->assertSee(route('legal.terms'));
        $response->assertSee('Política de Privacidade');
        $response->assertSee('Política de Cookies');
        $response->assertSee('Termos e Condições');
    }
}
