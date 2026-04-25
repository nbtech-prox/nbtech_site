<?php

namespace Tests\Feature\Web;

use App\Mail\NewBudgetRequestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BudgetRequestSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_budget_page_is_available(): void
    {
        $response = $this->get('/orcamento');

        $response->assertOk();
        $response->assertSee('Pedir orcamento');
    }

    public function test_budget_form_creates_a_budget_request(): void
    {
        Mail::fake();
        config(['mail.recipients.budget' => 'orcamento@nbtech.pt']);

        $payload = [
            'name' => 'Miguel Costa',
            'email' => 'miguel@empresa.pt',
            'company' => 'Empresa PT',
            'phone' => '+351912345678',
            'project_type' => 'website',
            'budget_range' => '2500-5000',
            'timeline' => '30-60-dias',
            'message' => 'Precisamos de um novo website com foco em conversao e geracao de leads.',
        ];

        $response = $this->post('/orcamento', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'miguel@empresa.pt',
            'name' => 'Miguel Costa',
            'type' => 'budget',
            'project_type' => 'website',
            'budget_range' => '2500-5000',
            'timeline' => '30-60-dias',
        ]);

        Mail::assertSent(NewBudgetRequestMail::class, function (NewBudgetRequestMail $mail): bool {
            return $mail->hasTo('orcamento@nbtech.pt')
                && $mail->message->email === 'miguel@empresa.pt';
        });
    }
}
