<?php

namespace App\Services;

use App\Repositories\ContactMessageRepository;
use App\Support\ContactMessageTypes;

class ContactService
{
    public function __construct(private readonly ContactMessageRepository $messages) {}

    public function createMessage(array $payload)
    {
        return $this->messages->create([
            ...$payload,
            'type' => ContactMessageTypes::CONTACT,
        ]);
    }

    public function createBudgetRequest(array $payload)
    {
        return $this->messages->create([
            ...$payload,
            'type' => ContactMessageTypes::BUDGET,
        ]);
    }
}
