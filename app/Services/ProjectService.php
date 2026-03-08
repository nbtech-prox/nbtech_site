<?php

namespace App\Services;

use App\DTOs\ProjectData;
use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService
{
    public function __construct(private readonly ProjectRepository $projects) {}

    public function create(ProjectData $data, ?string $coverPath = null, array $galleryPaths = [], ?string $ogPath = null): Project
    {
        $project = $this->projects->create($data->toArray());
        $this->syncMedia($project, $coverPath, $galleryPaths, $ogPath);

        return $project;
    }

    public function update(Project $project, ProjectData $data, ?string $coverPath = null, array $galleryPaths = [], ?string $ogPath = null): Project
    {
        $project = $this->projects->update($project, $data->toArray());
        $this->syncMedia($project, $coverPath, $galleryPaths, $ogPath);

        return $project;
    }

    public function delete(Project $project): void
    {
        $project->clearMediaCollection('cover');
        $project->clearMediaCollection('gallery');
        $project->clearMediaCollection('og_image');
        $this->projects->delete($project);
    }

    private function syncMedia(Project $project, ?string $coverPath, array $galleryPaths, ?string $ogPath): void
    {
        if ($coverPath) {
            $project->addMedia($coverPath)->toMediaCollection('cover');
        }

        if ($ogPath) {
            $project->addMedia($ogPath)->toMediaCollection('og_image');
        }

        foreach ($galleryPaths as $galleryPath) {
            $project->addMedia($galleryPath)->toMediaCollection('gallery');
        }

        $project->update([
            'cover_image' => $project->getFirstMediaUrl('cover') ?: null,
            'gallery_images' => $project->getMedia('gallery')->map(fn ($media) => $media->getUrl())->values()->all(),
        ]);
    }
}
