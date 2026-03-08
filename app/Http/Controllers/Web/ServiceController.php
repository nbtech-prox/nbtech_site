<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
}
