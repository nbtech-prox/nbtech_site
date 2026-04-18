<?php

namespace Tests\Unit;

use App\Models\ContactMessage;
use App\Support\ContactMessageTypes;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    public function test_contact_message_knows_its_type_labels(): void
    {
        $contact = new ContactMessage(['type' => ContactMessageTypes::CONTACT]);
        $budget = new ContactMessage(['type' => ContactMessageTypes::BUDGET]);

        $this->assertSame('Contacto geral', $contact->typeLabel());
        $this->assertSame('Pedido de orçamento', $budget->typeLabel());
    }
}
