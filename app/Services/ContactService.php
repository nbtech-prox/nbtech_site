<?php

namespace App\Services;

use App\Mail\NewBudgetRequestMail;
use App\Mail\NewContactMessageMail;
use App\Models\ContactMessage;
use App\Repositories\ContactMessageRepository;
use App\Support\ContactMessageTypes;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactService
{
    public function __construct(private readonly ContactMessageRepository $messages) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function createMessage(array $payload): ContactMessage
    {
        $message = $this->messages->create([
            ...$payload,
            'type' => ContactMessageTypes::CONTACT,
        ]);

        $this->sendNotification(fn () => Mail::to(config('mail.recipients.contact'))->send(new NewContactMessageMail($message)));

        return $message;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function createBudgetRequest(array $payload): ContactMessage
    {
        $message = $this->messages->create([
            ...$payload,
            'type' => ContactMessageTypes::BUDGET,
        ]);

        $this->sendNotification(fn () => Mail::to(config('mail.recipients.budget'))->send(new NewBudgetRequestMail($message)));

        return $message;
    }

    private function sendNotification(callable $callback): void
    {
        try {
            $callback();
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
