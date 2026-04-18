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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        $payload = $request->validated();

        if ($request->hasFile('image_file')) {
            $payload['image_url'] = $this->storeServiceImage($request->file('image_file'));
        }

        $service = $serviceService->create(ServiceData::fromArray($payload));

        return redirect()->route('admin.services.edit', $service)
            ->with('status', 'Serviço criado com sucesso.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(UpdateServiceRequest $request, Service $service, ServiceService $serviceService): RedirectResponse
    {
        $payload = $request->validated();

        if ($request->boolean('remove_image')) {
            $this->deleteManagedImage($service->image_url);
            $payload['image_url'] = null;
        }

        if ($request->hasFile('image_file')) {
            $this->deleteManagedImage($service->image_url);
            $payload['image_url'] = $this->storeServiceImage($request->file('image_file'));
        }

        $serviceService->update($service, ServiceData::fromArray($payload));

        return back()->with('status', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Service $service, ServiceService $serviceService): RedirectResponse
    {
        $this->deleteManagedImage($service->image_url);
        $serviceService->delete($service);

        return redirect()->route('admin.services.index')
            ->with('status', 'Serviço removido com sucesso.');
    }

    private function storeServiceImage(UploadedFile $file): string
    {
        $path = $file->store('services', 'public');

        return '/storage/'.$path;
    }

    private function deleteManagedImage(?string $url): void
    {
        if (! $url) {
            return;
        }

        $path = parse_url($url, PHP_URL_PATH) ?: $url;

        if (! is_string($path) || ! str_starts_with($path, '/storage/services/')) {
            return;
        }

        Storage::disk('public')->delete(ltrim(str_replace('/storage/', '', $path), '/'));
    }
}
