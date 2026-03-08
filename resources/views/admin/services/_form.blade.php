@php($service = $service ?? null)

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium">Título</label>
        <input name="title" required value="{{ old('title', $service?->title) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Ícone</label>
        <input name="icon" value="{{ old('icon', $service?->icon) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Descrição</label>
    <textarea name="description" rows="4" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">{{ old('description', $service?->description) }}</textarea>
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Ordem</label>
    <div class="number-stepper">
        <input id="service-order" type="number" min="0" name="order" value="{{ old('order', $service?->order ?? 0) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
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
