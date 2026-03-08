<?php

namespace App\Repositories;

use App\Models\ContactMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactMessageRepository
{
    public function create(array $attributes): ContactMessage
    {
        return ContactMessage::query()->create($attributes);
    }

    public function latestPaginated(?string $search = null): LengthAwarePaginator
    {
        return ContactMessage::query()
            ->when($search, fn ($query) => $query->where(function ($inner) use ($search): void {
                $inner->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();
    }

    public function latest(int $limit = 8)
    {
        return ContactMessage::query()
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }
}
