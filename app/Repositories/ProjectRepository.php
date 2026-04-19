<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectRepository
{
    public function paginateForAdmin(?string $search = null): LengthAwarePaginator
    {
        return Project::query()
            ->when($search, fn ($query) => $query->where(function ($inner) use ($search): void {
                $inner->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    public function paginatePublished(): LengthAwarePaginator
    {
        return Project::query()
            ->published()
            ->latest()
            ->paginate(9)
            ->withQueryString();
    }

    public function featured(int $limit = 3)
    {
        return Project::query()
            ->published()
            ->featured()
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function create(array $attributes): Project
    {
        return Project::query()->create($attributes);
    }

    public function update(Project $project, array $attributes): Project
    {
        $project->update($attributes);

        return $project->refresh();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
