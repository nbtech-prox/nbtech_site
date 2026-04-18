<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\TestimonialData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use App\Services\TestimonialService;
use App\Support\TestimonialStatuses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request, TestimonialRepository $testimonials): View
    {
        $this->authorize('viewAny', Testimonial::class);

        $statuses = TestimonialStatuses::labels();
        $selectedStatus = $request->string('status')->toString();

        if (! array_key_exists($selectedStatus, $statuses)) {
            $selectedStatus = '';
        }

        return view('admin.testimonials.index', [
            'testimonials' => $testimonials->paginateForAdmin(
                $request->string('q')->toString() ?: null,
                $selectedStatus !== '' ? $selectedStatus : null,
            ),
            'search' => $request->string('q')->toString(),
            'selectedStatus' => $selectedStatus,
            'statuses' => $statuses,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Testimonial::class);

        return view('admin.testimonials.create', [
            'statuses' => TestimonialStatuses::labels(),
        ]);
    }

    public function store(StoreTestimonialRequest $request, TestimonialService $service): RedirectResponse
    {
        $this->authorize('create', Testimonial::class);

        $testimonial = $service->create(TestimonialData::fromArray($request->validated()));

        return redirect()->route('admin.testimonials.edit', $testimonial)
            ->with('status', 'Testemunho criado com sucesso.');
    }

    public function edit(Testimonial $testimonial): View
    {
        $this->authorize('update', $testimonial);

        return view('admin.testimonials.edit', [
            'testimonial' => $testimonial,
            'statuses' => TestimonialStatuses::labels(),
        ]);
    }

    public function approve(Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $this->authorize('update', $testimonial);
        $service->setStatus($testimonial, TestimonialStatuses::APPROVED);

        return back()->with('status', 'Testemunho aprovado.');
    }

    public function markPending(Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $this->authorize('update', $testimonial);
        $service->setStatus($testimonial, TestimonialStatuses::PENDING);

        return back()->with('status', 'Testemunho marcado como pendente.');
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $this->authorize('update', $testimonial);

        $service->update($testimonial, TestimonialData::fromArray($request->validated()));

        return back()->with('status', 'Testemunho atualizado com sucesso.');
    }

    public function destroy(Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $this->authorize('delete', $testimonial);

        $service->delete($testimonial);

        return redirect()->route('admin.testimonials.index')
            ->with('status', 'Testemunho removido com sucesso.');
    }
}
