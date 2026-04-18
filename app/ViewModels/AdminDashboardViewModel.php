<?php

namespace App\ViewModels;

use App\Models\Project;
use App\Models\Testimonial;
use App\Repositories\ContactMessageRepository;
use App\Support\TestimonialStatuses;

class AdminDashboardViewModel
{
    public function __construct(private readonly ContactMessageRepository $messages) {}

    public function toArray(): array
    {
        return [
            'projectCount' => Project::query()->count(),
            'featuredCount' => Project::query()->where('featured', true)->count(),
            'pendingTestimonialsCount' => Testimonial::query()->where('status', TestimonialStatuses::PENDING)->count(),
            'recentMessages' => $this->messages->latest(),
            'recentProjects' => Project::query()->latest()->limit(5)->get(),
        ];
    }
}
