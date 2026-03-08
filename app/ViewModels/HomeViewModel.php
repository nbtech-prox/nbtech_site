<?php

namespace App\ViewModels;

use App\Repositories\ProjectRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TestimonialRepository;

class HomeViewModel
{
    public function __construct(
        private readonly ServiceRepository $services,
        private readonly ProjectRepository $projects,
        private readonly TestimonialRepository $testimonials,
    ) {}

    public function toArray(): array
    {
        return [
            'services' => rescue(fn () => $this->services->allOrdered(), collect()),
            'featuredProjects' => rescue(fn () => $this->projects->featured(6), collect()),
            'testimonials' => rescue(fn () => $this->testimonials->latest(6), collect()),
        ];
    }
}
