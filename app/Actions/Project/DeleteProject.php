<?php

namespace App\Actions\Project;

use App\Models\Project;
use App\Services\ProjectService;

class DeleteProject
{
    public function __construct(private readonly ProjectService $service) {}

    public function handle(Project $project): void
    {
        $this->service->delete($project);
    }
}
