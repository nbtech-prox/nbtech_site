<?php

namespace App\Services;

use App\Repositories\ContactMessageRepository;

class ContactService
{
    public function __construct(private readonly ContactMessageRepository $messages) {}

    public function createMessage(array $payload)
    {
        return $this->messages->create($payload);
    }
}
