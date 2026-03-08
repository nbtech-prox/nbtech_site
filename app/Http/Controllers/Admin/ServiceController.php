<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\ServiceData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use App\Services\ServiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request, ServiceRepository $services): View
    {
        return view('admin.services.index', [
            'services' => $services->paginateForAdmin($request->string('q')->toString() ?: null),
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request, ServiceService $serviceService): RedirectResponse
    {
        $service = $serviceService->create(ServiceData::fromArray($request->validated()));

        return redirect()->route('admin.services.edit', $service)
            ->with('status', 'Serviço criado com sucesso.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(UpdateServiceRequest $request, Service $service, ServiceService $serviceService): RedirectResponse
    {
        $serviceService->update($service, ServiceData::fromArray($request->validated()));

        return back()->with('status', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Service $service, ServiceService $serviceService): RedirectResponse
    {
        $serviceService->delete($service);

        return redirect()->route('admin.services.index')
            ->with('status', 'Serviço removido com sucesso.');
    }
}
