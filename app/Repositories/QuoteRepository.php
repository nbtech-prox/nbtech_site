<?php

namespace App\Repositories;

use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QuoteRepository
{
    public function paginateForAdmin(?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        return Quote::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search, fn ($query) => $query->where(function ($searchQuery) use ($search): void {
                $searchQuery
                    ->where('number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%");
            }))
            ->latest('issue_date')
            ->paginate(12)
            ->withQueryString();
    }
}
