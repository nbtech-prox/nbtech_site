<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;

class QuotePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Quote $quote): bool
    {
        return $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Quote $quote): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Quote $quote): bool
    {
        return $user->hasRole('admin');
    }
}
