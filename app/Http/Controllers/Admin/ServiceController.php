<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\ServiceData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request, ServiceRepository $services): View
    {
        $this->authorize('viewAny', Service::class);

        return view('admin.services.index', [
            'services' => $services->paginateForAdmin($request->string('q')->toString() ?: null),
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Service::class);

        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request, ServiceRepository $services): RedirectResponse
    {
        $this->authorize('create', Service::class);

        $payload = $request->validated();

        if ($request->hasFile('image_file')) {
            $payload['image_url'] = $this->storeServiceImage($request->file('image_file'));
        }

        $service = $services->create(ServiceData::fromArray($payload)->toArray());

        return redirect()->route('admin.services.edit', $service)
            ->with('status', 'Serviço criado com sucesso.');
    }

    public function edit(Service $service): View
    {
        $this->authorize('update', $service);

        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(UpdateServiceRequest $request, Service $service, ServiceRepository $services): RedirectResponse
    {
        $this->authorize('update', $service);

        $payload = $request->validated();

        if ($request->boolean('remove_image')) {
            $this->deleteManagedImage($service->image_url);
            $payload['image_url'] = null;
        }

        if ($request->hasFile('image_file')) {
            $this->deleteManagedImage($service->image_url);
            $payload['image_url'] = $this->storeServiceImage($request->file('image_file'));
        }

        $services->update($service, ServiceData::fromArray($payload)->toArray());

        return back()->with('status', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Service $service, ServiceRepository $services): RedirectResponse
    {
        $this->authorize('delete', $service);

        $this->deleteManagedImage($service->image_url);
        $services->delete($service);

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
