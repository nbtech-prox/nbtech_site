<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Project\CreateProject;
use App\Actions\Project\DeleteProject;
use App\Actions\Project\UpdateProject;
use App\DTOs\ProjectData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request, ProjectRepository $projects): View
    {
        $this->authorize('viewAny', Project::class);

        return view('admin.projects.index', [
            'projects' => $projects->paginateForAdmin(
                search: $request->string('q')->toString() ?: null,
                category: $request->string('category')->toString() ?: null,
            ),
            'filters' => [
                'q' => $request->string('q')->toString(),
                'category' => $request->string('category')->toString(),
            ],
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Project::class);

        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request, CreateProject $action): RedirectResponse
    {
        $this->authorize('create', Project::class);

        $data = ProjectData::fromArray($request->validated());

        $project = $action->handle(
            data: $data,
            coverPath: $request->file('cover_image')?->getRealPath(),
            galleryPaths: collect($request->file('gallery_images', []))->map->getRealPath()->all(),
            ogPath: $request->file('og_image')?->getRealPath(),
        );

        return redirect()->route('admin.projects.edit', $project)
            ->with('status', 'Projeto criado com sucesso.');
    }

    public function edit(Project $project): View
    {
        $this->authorize('update', $project);

        return view('admin.projects.edit', [
            'project' => $project,
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project, UpdateProject $action): RedirectResponse
    {
        $this->authorize('update', $project);

        $data = ProjectData::fromArray($request->validated());

        $action->handle(
            project: $project,
            data: $data,
            coverPath: $request->file('cover_image')?->getRealPath(),
            galleryPaths: collect($request->file('gallery_images', []))->map->getRealPath()->all(),
            ogPath: $request->file('og_image')?->getRealPath(),
        );

        return back()->with('status', 'Projeto atualizado com sucesso.');
    }

    public function destroy(Project $project, DeleteProject $action): RedirectResponse
    {
        $this->authorize('delete', $project);

        $action->handle($project);

        return redirect()->route('admin.projects.index')
            ->with('status', 'Projeto removido com sucesso.');
    }
}
