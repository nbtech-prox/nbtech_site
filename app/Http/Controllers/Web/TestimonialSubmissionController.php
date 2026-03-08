<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StorePublicTestimonialRequest;
use App\Services\TestimonialService;
use Illuminate\Http\RedirectResponse;

class TestimonialSubmissionController extends Controller
{
    public function store(StorePublicTestimonialRequest $request, TestimonialService $service): RedirectResponse
    {
        $service->createFromPublic($request->validated());

        return back()->with('status', 'Obrigado! A tua mensagem foi recebida e ficará visível após validação.');
    }
}
