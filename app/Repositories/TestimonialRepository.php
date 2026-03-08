<?php

namespace App\Repositories;

use App\Models\Testimonial;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TestimonialRepository
{
    public function latest(int $limit = 6): Collection
    {
        return Testimonial::query()
            ->where('status', 'approved')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function paginateForAdmin(?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        return Testimonial::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search, fn ($query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('company', 'like', "%{$search}%")
                ->orWhere('quote', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    public function create(array $attributes): Testimonial
    {
        return Testimonial::query()->create($attributes);
    }

    public function update(Testimonial $testimonial, array $attributes): Testimonial
    {
        $testimonial->update($attributes);

        return $testimonial->refresh();
    }

    public function delete(Testimonial $testimonial): void
    {
        $testimonial->delete();
    }
}
