<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\TestimonialData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use App\Services\TestimonialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request, TestimonialRepository $testimonials): View
    {
        $statuses = $this->statuses();
        $selectedStatus = $request->string('status')->toString();

        if (!array_key_exists($selectedStatus, $statuses)) {
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
        return view('admin.testimonials.create', [
            'statuses' => $this->statuses(),
        ]);
    }

    public function store(StoreTestimonialRequest $request, TestimonialService $service): RedirectResponse
    {
        $testimonial = $service->create(TestimonialData::fromArray($request->validated()));

        return redirect()->route('admin.testimonials.edit', $testimonial)
            ->with('status', 'Testemunho criado com sucesso.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', [
            'testimonial' => $testimonial,
            'statuses' => $this->statuses(),
        ]);
    }

    public function approve(Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $service->setStatus($testimonial, 'approved');

        return back()->with('status', 'Testemunho aprovado.');
    }

    public function markPending(Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $service->setStatus($testimonial, 'pending');

        return back()->with('status', 'Testemunho marcado como pendente.');
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $service->update($testimonial, TestimonialData::fromArray($request->validated()));

        return back()->with('status', 'Testemunho atualizado com sucesso.');
    }

    public function destroy(Testimonial $testimonial, TestimonialService $service): RedirectResponse
    {
        $service->delete($testimonial);

        return redirect()->route('admin.testimonials.index')
            ->with('status', 'Testemunho removido com sucesso.');
    }

    /**
     * @return array<string, string>
     */
    private function statuses(): array
    {
        return [
            'pending' => 'Pendente',
            'approved' => 'Aprovado',
        ];
    }
}
