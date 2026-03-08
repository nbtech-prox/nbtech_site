<?php

namespace App\Actions\Project;

use App\DTOs\ProjectData;
use App\Services\ProjectService;

class CreateProject
{
    public function __construct(private readonly ProjectService $service) {}

    public function handle(ProjectData $data, ?string $coverPath = null, array $galleryPaths = [], ?string $ogPath = null)
    {
        return $this->service->create($data, $coverPath, $galleryPaths, $ogPath);
    }
}
