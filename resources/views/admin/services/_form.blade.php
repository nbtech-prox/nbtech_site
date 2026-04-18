@php
    $service = $service ?? null;

    $normalizeMediaUrl = static function (?string $url): ?string {
        if (! $url) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $path = parse_url($url, PHP_URL_PATH);

        if (in_array($host, ['localhost', '127.0.0.1'], true) && $path) {
            return $path;
        }

        return $url;
    };

    $currentImage = $normalizeMediaUrl($service?->image_url);
    $currentImage = $currentImage ?? null;
@endphp

@if ($errors->any())
    <div class="mb-4 rounded-xl border border-rose-300 bg-rose-50 p-3 text-sm text-rose-700">
        <p class="font-semibold">Existem campos por corrigir:</p>
        <ul class="mt-1 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium">Título</label>
        <input name="title" required value="{{ old('title', $service?->title) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('title'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('title')]) aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}">
        @error('title')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Ícone</label>
        <input name="icon" value="{{ old('icon', $service?->icon) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('icon'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('icon')]) aria-invalid="{{ $errors->has('icon') ? 'true' : 'false' }}">
        @error('icon')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">URL da imagem do card</label>
        <input name="image_url" value="{{ old('image_url', $service?->image_url) }}" placeholder="https://..." @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('image_url'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('image_url')]) aria-invalid="{{ $errors->has('image_url') ? 'true' : 'false' }}">
        @error('image_url')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium" for="image_file">Imagem do card (upload)</label>
        <input id="image_file" type="file" name="image_file" accept="image/*" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('image_file'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('image_file')]) aria-invalid="{{ $errors->has('image_file') ? 'true' : 'false' }}">
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Se enviar uma imagem, substitui a URL acima.</p>
        @error('image_file')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
        @if ($currentImage)
            <div class="mt-3 overflow-hidden rounded-lg border border-slate-300/70 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/60">
                <div class="flex items-center justify-between border-b border-slate-200 px-3 py-2 text-xs text-slate-600 dark:border-slate-700 dark:text-slate-300">
                    <span>Pré-visualização da imagem atual</span>
                    <a href="{{ $currentImage }}" target="_blank" rel="noopener" class="font-semibold text-brand-600 hover:underline">Abrir imagem</a>
                </div>
                <div class="grid place-items-center bg-[radial-gradient(circle_at_center,rgba(148,163,184,0.18)_0,rgba(148,163,184,0.08)_45%,transparent_80%)] p-3 dark:bg-[radial-gradient(circle_at_center,rgba(148,163,184,0.15)_0,rgba(148,163,184,0.06)_45%,transparent_80%)]">
                    <img src="{{ $currentImage }}" alt="Imagem atual do serviço" class="max-h-72 w-full rounded-md object-contain">
                </div>
            </div>
            <label class="mt-2 inline-flex items-center gap-2 text-xs text-rose-600 dark:text-rose-400">
                <input type="checkbox" name="remove_image" value="1" @checked(old('remove_image'))>
                Remover imagem atual
            </label>
        @endif
    </div>
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Descrição</label>
    <textarea name="description" rows="4" required @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('description'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('description')]) aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}">{{ old('description', $service?->description) }}</textarea>
    @error('description')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Ordem</label>
    <div class="number-stepper">
        <input id="service-order" type="number" min="0" name="order" value="{{ old('order', $service?->order ?? 0) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('order'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('order')]) aria-invalid="{{ $errors->has('order') ? 'true' : 'false' }}">
        @error('order')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
        <div class="number-stepper-controls">
            <button type="button" class="number-stepper-btn" data-step-up="service-order" aria-label="Aumentar ordem">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 14 6-6 6 6"/></svg>
            </button>
            <button type="button" class="number-stepper-btn" data-step-down="service-order" aria-label="Diminuir ordem">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 10 6 6 6-6"/></svg>
            </button>
        </div>
    </div>
</div>
