<?php

namespace App\Services;

use App\DTOs\TestimonialData;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use App\Support\TestimonialStatuses;

class TestimonialService
{
    public function __construct(private readonly TestimonialRepository $testimonials) {}

    public function create(TestimonialData $data): Testimonial
    {
        return $this->testimonials->create($data->toArray());
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function createFromPublic(array $payload): Testimonial
    {
        return $this->testimonials->create([
            'name' => $payload['name'],
            'company' => $payload['company'] ?? null,
            'company_url' => $payload['company_url'] ?? null,
            'quote' => $payload['quote'],
            'rating' => (int) ($payload['rating'] ?? 5),
            'status' => TestimonialStatuses::PENDING,
        ]);
    }

    public function update(Testimonial $testimonial, TestimonialData $data): Testimonial
    {
        return $this->testimonials->update($testimonial, $data->toArray());
    }

    public function delete(Testimonial $testimonial): void
    {
        $this->testimonials->delete($testimonial);
    }

    public function setStatus(Testimonial $testimonial, string $status): Testimonial
    {
        return $this->testimonials->update($testimonial, ['status' => $status]);
    }
}
