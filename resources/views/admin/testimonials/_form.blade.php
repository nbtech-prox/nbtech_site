@php($testimonial = $testimonial ?? null)

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium">Nome</label>
        <input name="name" required value="{{ old('name', $testimonial?->name) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Empresa</label>
        <input name="company" value="{{ old('company', $testimonial?->company) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Website da empresa (opcional)</label>
    <input name="company_url" value="{{ old('company_url', $testimonial?->company_url) }}" placeholder="https://..." class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
</div>
<div class="mt-4 max-w-sm">
    <label class="mb-1 block text-sm font-medium">Pontuação</label>
    <select name="rating" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
        @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" @selected((int) old('rating', $testimonial?->rating ?? 5) === $i)>{{ str_repeat('★', $i) }} ({{ $i }})</option>
        @endfor
    </select>
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Citação</label>
    <textarea name="quote" rows="4" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">{{ old('quote', $testimonial?->quote) }}</textarea>
</div>
<div class="mt-4 max-w-sm">
    <label class="mb-1 block text-sm font-medium">Estado</label>
    <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
        @foreach (($statuses ?? ['pending' => 'Pendente', 'approved' => 'Aprovado']) as $statusKey => $statusLabel)
            <option value="{{ $statusKey }}" @selected(old('status', $testimonial?->status ?? 'approved') === $statusKey)>{{ $statusLabel }}</option>
        @endforeach
    </select>
</div>
