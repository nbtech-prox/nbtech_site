<?php

namespace App\DTOs;

class ServiceData
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $slug,
        public readonly ?string $icon,
        public readonly ?string $imageUrl,
        public readonly int $order,
        public readonly ?string $metaTitle,
        public readonly ?string $metaDescription,
    ) {}

    public static function fromArray(array $payload): self
    {
        return new self(
            title: $payload['title'],
            description: $payload['description'],
            slug: $payload['slug'] ?? null,
            icon: $payload['icon'] ?? null,
            imageUrl: $payload['image_url'] ?? null,
            order: (int) ($payload['order'] ?? 0),
            metaTitle: $payload['meta_title'] ?? null,
            metaDescription: $payload['meta_description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'image_url' => $this->imageUrl,
            'order' => $this->order,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
        ];
    }
}
