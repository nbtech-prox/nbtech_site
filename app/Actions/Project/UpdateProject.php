<?php

namespace App\Actions\Project;

use App\DTOs\ProjectData;
use App\Models\Project;
use App\Services\ProjectService;

class UpdateProject
{
    public function __construct(private readonly ProjectService $service) {}

    public function handle(Project $project, ProjectData $data, ?string $coverPath = null, array $galleryPaths = [], ?string $ogPath = null)
    {
        return $this->service->update($project, $data, $coverPath, $galleryPaths, $ogPath);
    }
}
