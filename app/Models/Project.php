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

        return collect(config('frontend_content.project_gallery_fallbacks.'.$this->slug, []));
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
