<?php

namespace Tests\Feature\Web;

use App\Mail\NewContactMessageMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_creates_a_contact_message(): void
    {
        Mail::fake();
        config(['mail.recipients.contact' => 'info@nbtech.pt']);

        $payload = [
            'name' => 'Rita Silva',
            'email' => 'rita@empresa.pt',
            'company' => 'Empresa PT',
            'message' => 'Precisamos de uma plataforma digital com integrações API.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Mensagem enviada com sucesso. A NBTech recebeu o teu contacto e responderá assim que possível.');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'rita@empresa.pt',
            'name' => 'Rita Silva',
            'type' => 'contact',
        ]);

        Mail::assertSent(NewContactMessageMail::class, function (NewContactMessageMail $mail): bool {
            return $mail->hasTo('info@nbtech.pt')
                && $mail->message->email === 'rita@empresa.pt';
        });
    }
}
