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
}
