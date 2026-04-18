<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_creates_a_contact_message(): void
    {
        $payload = [
            'name' => 'Rita Silva',
            'email' => 'rita@empresa.pt',
            'company' => 'Empresa PT',
            'message' => 'Precisamos de uma plataforma digital com integrações API.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'rita@empresa.pt',
            'name' => 'Rita Silva',
            'type' => 'contact',
        ]);
    }
}
