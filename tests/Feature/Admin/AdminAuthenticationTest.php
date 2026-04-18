<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_redirects_guests_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('login'));
    }

    public function test_login_page_contains_password_visibility_toggle(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
        $response->assertSee('id="password"', false);
        $response->assertSee('data-password-toggle', false);
        $response->assertSee('aria-label="Mostrar password"', false);
    }
}
