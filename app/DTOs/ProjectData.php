<?php

namespace App\DTOs;

class ProjectData
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $description,
        public readonly array $technologies,
        public readonly ?string $projectUrl,
        public readonly ?string $category,
        public readonly bool $featured,
        public readonly bool $published,
        public readonly ?string $metaTitle,
        public readonly ?string $metaDescription,
    ) {}

    public static function fromArray(array $payload): self
    {
        return new self(
            title: $payload['title'],
            slug: $payload['slug'],
            description: $payload['description'],
            technologies: self::normalizeTechnologies($payload['technologies'] ?? []),
            projectUrl: $payload['project_url'] ?? null,
            category: self::normalizeNullableString($payload['category'] ?? null),
            featured: (bool) ($payload['featured'] ?? false),
            published: (bool) ($payload['published'] ?? false),
            metaTitle: $payload['meta_title'] ?? null,
            metaDescription: $payload['meta_description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'technologies' => $this->technologies,
            'project_url' => $this->projectUrl,
            'category' => $this->category,
            'featured' => $this->featured,
            'published' => $this->published,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
        ];
    }

    private static function normalizeTechnologies(array|string $technologies): array
    {
        if (is_string($technologies)) {
            $technologies = explode(',', $technologies);
        }

        return array_values(array_filter(array_map(
            static fn (string $item): string => trim($item),
            $technologies,
        )));
    }

    private static function normalizeNullableString(?string $value): ?string
    {
        $value = $value !== null ? trim($value) : null;

        return $value !== '' ? $value : null;
    }
}
