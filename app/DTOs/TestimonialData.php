<?php

namespace App\DTOs;

class TestimonialData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $company,
        public readonly ?string $companyUrl,
        public readonly string $quote,
        public readonly int $rating,
        public readonly string $status,
    ) {}

    public static function fromArray(array $payload): self
    {
        return new self(
            name: $payload['name'],
            company: $payload['company'] ?? null,
            companyUrl: $payload['company_url'] ?? null,
            quote: $payload['quote'],
            rating: (int) ($payload['rating'] ?? 5),
            status: $payload['status'] ?? 'approved',
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'company' => $this->company,
            'company_url' => $this->companyUrl,
            'quote' => $this->quote,
            'rating' => $this->rating,
            'status' => $this->status,
        ];
    }
}
