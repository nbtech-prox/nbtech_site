<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('web.contact');
    }

    public function store(StoreContactMessageRequest $request, ContactService $service): RedirectResponse
    {
        $service->createMessage($request->validated());

        return back()->with('status', 'Pedido recebido com sucesso. A NBTech vai analisar o contexto enviado e responder com proximos passos claros.');
    }
}
