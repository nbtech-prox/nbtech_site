<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'technologies',
        'cover_image',
        'gallery_images',
        'project_url',
        'category',
        'featured',
        'published',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'gallery_images' => 'array',
            'featured' => 'boolean',
            'published' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
        $this->addMediaCollection('og_image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(720)
            ->height(480)
            ->nonQueued();
    }

    public function previewGalleryItems(): Collection
    {
        $mediaItems = $this->getMedia('gallery')->map(fn (Media $media) => [
            'src' => $media->getUrl(),
            'alt' => 'Imagem do projeto '.$this->title,
        ])->values();

        if ($mediaItems->isNotEmpty()) {
            return $mediaItems;
        }

        $legacyGallery = collect($this->gallery_images)
            ->filter(fn ($item) => is_string($item) && $item !== '')
            ->values()
            ->map(fn (string $url) => [
                'src' => $url,
                'alt' => 'Imagem do projeto '.$this->title,
            ]);

        if ($legacyGallery->isNotEmpty()) {
            return $legacyGallery;
        }

        return collect(match ($this->slug) {
            'popsmart-pt' => [
                ['src' => 'https://popsmart.pt/wp-content/uploads/2026/01/11X-Preto.jpg', 'alt' => 'PopSmart Smartwatch S11 Preto'],
                ['src' => 'https://popsmart.pt/wp-content/uploads/2026/01/11X-Prata.jpg', 'alt' => 'PopSmart Smartwatch S11 Prata'],
                ['src' => 'https://popsmart.pt/wp-content/uploads/2026/01/Ultra-5-Pro-Preto.jpg', 'alt' => 'PopSmart Smartwatch Ultra 5 Pro'],
                ['src' => 'https://popsmart.pt/wp-content/uploads/2024/11/design-sem-nome.zip-1-2-scaled.png', 'alt' => 'PopSmart Kit AI-60 12 em 1'],
                ['src' => 'https://popsmart.pt/wp-content/uploads/2025/01/escova_styler_5_em_1_foto2.jpg', 'alt' => 'PopSmart Outros artigos'],
                ['src' => 'https://popsmart.pt/wp-content/uploads/2025/04/airpods4.png', 'alt' => 'PopSmart AirPods e InPods'],
            ],
            'ecovinyl-nbtech-pt' => [
                ['src' => 'https://ecovinyl.pt/wp-content/uploads/2017/11/Ecovinyl011-1920x1200.jpg', 'alt' => 'Ecovinyl - trabalho aplicado em fachada'],
                ['src' => 'https://ecovinyl.pt/wp-content/uploads/2017/11/Ecovinyl033-1920x1200.jpg', 'alt' => 'Ecovinyl - projeto de branding exterior'],
                ['src' => 'https://ecovinyl.pt/wp-content/uploads/2017/11/Ecovinyl016.jpg', 'alt' => 'Ecovinyl - instalação profissional em vinil'],
                ['src' => 'https://ecovinyl.pt/wp-content/uploads/2017/11/Ecovinyl024.jpg', 'alt' => 'Ecovinyl - detalhe de acabamento e aplicação'],
                ['src' => 'https://ecovinyl.pt/wp-content/uploads/2018/03/Acrilicos.jpg', 'alt' => 'Ecovinyl - peças em acrílico e sinalética'],
                ['src' => 'https://ecovinyl.pt/wp-content/uploads/2018/03/placas.jpg', 'alt' => 'Ecovinyl - placas e comunicação visual'],
            ],
            default => [],
        });
    }

    public function previewCoverUrl(): ?string
    {
        $cover = $this->getFirstMediaUrl('cover');

        if ($cover !== '') {
            return $cover;
        }

        if (is_string($this->cover_image) && $this->cover_image !== '') {
            return $this->cover_image;
        }

        return $this->previewGalleryItems()->first()['src'] ?? null;
    }

    public function previewOgUrl(): ?string
    {
        $og = $this->getFirstMediaUrl('og_image');

        if ($og !== '') {
            return $og;
        }

        return $this->previewCoverUrl();
    }
}
