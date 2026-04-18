<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'image_url',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $service): void {
            if (! $service->slug) {
                $service->slug = Str::slug($service->title);
            }

            if (! $service->meta_title) {
                $service->meta_title = $service->title.' | NBTech';
            }

            if (! $service->meta_description) {
                $service->meta_description = Str::limit('Conhece o serviço '.$service->title.' da NBTech e percebe como podemos ajudar a melhorar clareza, performance e crescimento digital.', 300);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function pageContent(): array
    {
        $defaults = config('frontend_content.services.defaults', []);
        $items = config('frontend_content.services.items', []);

        return array_merge($defaults, $items[$this->slug] ?? []);
    }

    public function schemaData(): array
    {
        $content = $this->pageContent();

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Service',
                    '@id' => route('services.show', $this).'#service',
                    'name' => $this->title,
                    'description' => $this->meta_description ?: $this->description,
                    'provider' => [
                        '@type' => 'Organization',
                        'name' => 'NBTech',
                        'url' => route('home'),
                    ],
                    'serviceType' => $this->title,
                    'url' => route('services.show', $this),
                    'areaServed' => 'PT',
                ],
                [
                    '@type' => 'BreadcrumbList',
                    '@id' => route('services.show', $this).'#breadcrumb',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => 'Início',
                            'item' => route('home'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => 'Serviços',
                            'item' => route('services.index'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $this->title,
                            'item' => route('services.show', $this),
                        ],
                    ],
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => route('services.show', $this).'#faq',
                    'mainEntity' => collect($content['faqs'])
                        ->map(fn (array $faq) => [
                            '@type' => 'Question',
                            'name' => $faq['question'],
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $faq['answer'],
                            ],
                        ])->all(),
                ],
            ],
        ];
    }
}
