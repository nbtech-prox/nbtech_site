<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSubmissionThrottleTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_is_rate_limited(): void
    {
        $payload = [
            'name' => 'Rita Silva',
            'email' => 'rita@example.com',
            'company' => 'Empresa PT',
            'message' => 'Mensagem suficientemente longa para validação.',
        ];

        for ($i = 0; $i < 5; $i++) {
            $this->post(route('contact.store'), $payload)->assertRedirect();
        }

        $this->post(route('contact.store'), $payload)->assertStatus(429);
    }

    public function test_budget_form_is_rate_limited(): void
    {
        $payload = [
            'name' => 'Miguel Costa',
            'email' => 'miguel@example.com',
            'company' => 'Empresa PT',
            'phone' => '+351912345678',
            'project_type' => 'website',
            'budget_range' => '2500-5000',
            'timeline' => '30-60-dias',
            'message' => 'Precisamos de um website novo com foco em conversão.',
        ];

        for ($i = 0; $i < 5; $i++) {
            $this->post(route('budget.store'), $payload)->assertRedirect();
        }

        $this->post(route('budget.store'), $payload)->assertStatus(429);
    }

    public function test_public_testimonial_form_is_rate_limited(): void
    {
        $payload = [
            'name' => 'Joana Silva',
            'company' => 'Empresa PT',
            'company_url' => 'https://example.com',
            'quote' => 'Testemunho público suficientemente longo para passar a validação sem problemas.',
            'rating' => 5,
        ];

        for ($i = 0; $i < 5; $i++) {
            $this->post(route('testimonials.store'), $payload)->assertRedirect();
        }

        $this->post(route('testimonials.store'), $payload)->assertStatus(429);
    }
}
