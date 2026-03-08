<?php

namespace App\DTOs;

class ServiceData
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $icon,
        public readonly int $order,
    ) {}

    public static function fromArray(array $payload): self
    {
        return new self(
            title: $payload['title'],
            description: $payload['description'],
            icon: $payload['icon'] ?? null,
            order: (int) ($payload['order'] ?? 0),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'order' => $this->order,
        ];
    }
}
