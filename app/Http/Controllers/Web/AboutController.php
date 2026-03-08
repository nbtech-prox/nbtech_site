<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\TestimonialRepository;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(TestimonialRepository $testimonials): View
    {
        return view('web.about', [
            'testimonials' => $testimonials->latest(),
        ]);
    }
}
