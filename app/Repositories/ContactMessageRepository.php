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

    public function latestPaginated(?string $search = null, ?string $type = null): LengthAwarePaginator
    {
        return ContactMessage::query()
            ->when($type, fn ($query) => $query->where('type', $type))
            ->when($search, fn ($query) => $query->where(function ($inner) use ($search): void {
                $inner->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
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

    public function nextAfter(ContactMessage $message): ?ContactMessage
    {
        /** @var ContactMessage|null $next */
        $next = ContactMessage::query()
            ->where('created_at', '<', $message->created_at)
            ->orWhere(function ($query) use ($message): void {
                $query->where('created_at', '=', $message->created_at)
                    ->where('id', '<', $message->id);
            })
            ->latest('created_at')
            ->latest('id')
            ->first();

        return $next;
    }
}
