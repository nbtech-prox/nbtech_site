<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(ProjectRepository $projects): View
    {
        return view('web.portfolio.index', [
            'projects' => $projects->paginatePublished(),
        ]);
    }

    public function show(Project $project): View
    {
        abort_if(! $project->published, 404);

        $galleryMedia = $project->getMedia('gallery');
        $galleryItems = $project->previewGalleryItems();

        return view('web.portfolio.show', [
            'project' => $project,
            'gallery' => $galleryMedia,
            'galleryItems' => $galleryItems,
            'cover' => $project->previewCoverUrl(),
            'ogImage' => $project->previewOgUrl(),
        ]);
    }
}
