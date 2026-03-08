<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Repositories\ContactMessageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request, ContactMessageRepository $messages): View
    {
        return view('admin.messages.index', [
            'messages' => $messages->latestPaginated($request->string('q')->toString() ?: null),
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function show(ContactMessage $message): View
    {
        return view('admin.messages.show', [
            'message' => $message,
        ]);
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('status', 'Mensagem removida com sucesso.');
    }
}
