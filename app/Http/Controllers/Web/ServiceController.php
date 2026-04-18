<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __invoke(ServiceRepository $services): View
    {
        return view('web.services', [
            'services' => $services->allOrdered(),
        ]);
    }

    public function show(Service $service, ServiceRepository $services): View
    {
        return view('web.services.show', [
            'service' => $service,
            'services' => $services->allOrdered()->where('id', '!=', $service->id)->take(3),
        ]);
    }
}
