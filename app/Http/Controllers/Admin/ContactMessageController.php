<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Repositories\ContactMessageRepository;
use App\Support\ContactMessageTypes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function __construct(private readonly ContactMessageRepository $messages) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', ContactMessage::class);

        $types = ContactMessageTypes::labels();
        $selectedType = $request->string('type')->toString();

        if (! array_key_exists($selectedType, $types)) {
            $selectedType = '';
        }

        return view('admin.messages.index', [
            'messages' => $this->messages->latestPaginated(
                $request->string('q')->toString() ?: null,
                $selectedType !== '' ? $selectedType : null,
            ),
            'search' => $request->string('q')->toString(),
            'selectedType' => $selectedType,
            'types' => $types,
        ]);
    }

    public function show(ContactMessage $message): View
    {
        $this->authorize('view', $message);

        return view('admin.messages.show', [
            'message' => $message,
            'nextMessage' => $this->messages->nextAfter($message),
        ]);
    }

    public function destroy(Request $request, ContactMessage $message): RedirectResponse
    {
        $this->authorize('delete', $message);

        $message->delete();

        if ($request->boolean('redirect_to_next')) {
            $next = $this->messages->nextAfter($message);

            if ($next) {
                return redirect()->route('admin.messages.show', $next)
                    ->with('status', 'Mensagem removida. A mostrar a mensagem seguinte.');
            }
        }

        return redirect()->route('admin.messages.index')
            ->with('status', 'Mensagem removida com sucesso.');
    }
}
