<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    public function allOrdered(): Collection
    {
        return Service::query()->orderBy('order')->get();
    }

    public function paginateForAdmin(?string $search = null): LengthAwarePaginator
    {
        return Service::query()
            ->when($search, fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->orderBy('order')
            ->paginate(12)
            ->withQueryString();
    }

    public function create(array $attributes): Service
    {
        return Service::query()->create($attributes);
    }

    public function update(Service $service, array $attributes): Service
    {
        $service->update($attributes);

        return $service->refresh();
    }

    public function delete(Service $service): void
    {
        $service->delete();
    }
}
