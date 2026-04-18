<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBudgetRequest;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BudgetRequestController extends Controller
{
    public function index(): View
    {
        return view('web.budget');
    }

    public function store(StoreBudgetRequest $request, ContactService $service): RedirectResponse
    {
        $service->createBudgetRequest($request->validated());

        return back()->with('status', 'Pedido de orçamento recebido com sucesso. A NBTech vai analisar o teu contexto e responder com próximos passos claros.');
    }
}
