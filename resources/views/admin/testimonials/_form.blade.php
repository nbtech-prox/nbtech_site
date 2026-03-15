@php($testimonial = $testimonial ?? null)

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
        <label class="mb-1 block text-sm font-medium">Nome</label>
        <input name="name" required value="{{ old('name', $testimonial?->name) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('name'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('name')]) aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
        @error('name')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Empresa</label>
        <input name="company" value="{{ old('company', $testimonial?->company) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('company'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('company')]) aria-invalid="{{ $errors->has('company') ? 'true' : 'false' }}">
        @error('company')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Website da empresa (opcional)</label>
    <input name="company_url" value="{{ old('company_url', $testimonial?->company_url) }}" placeholder="https://..." @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('company_url'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('company_url')]) aria-invalid="{{ $errors->has('company_url') ? 'true' : 'false' }}">
    @error('company_url')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div class="mt-4 max-w-sm">
    <label class="mb-1 block text-sm font-medium">Pontuação</label>
    <select name="rating" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('rating'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('rating')]) aria-invalid="{{ $errors->has('rating') ? 'true' : 'false' }}">
        @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" @selected((int) old('rating', $testimonial?->rating ?? 5) === $i)>{{ str_repeat('★', $i) }} ({{ $i }})</option>
        @endfor
    </select>
    @error('rating')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div class="mt-4">
    <label class="mb-1 block text-sm font-medium">Citação</label>
    <textarea name="quote" rows="4" required @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('quote'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('quote')]) aria-invalid="{{ $errors->has('quote') ? 'true' : 'false' }}">{{ old('quote', $testimonial?->quote) }}</textarea>
    @error('quote')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div class="mt-4 max-w-sm">
    <label class="mb-1 block text-sm font-medium">Estado</label>
    <select name="status" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('status'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('status')]) aria-invalid="{{ $errors->has('status') ? 'true' : 'false' }}">
        @foreach (($statuses ?? ['pending' => 'Pendente', 'approved' => 'Aprovado']) as $statusKey => $statusLabel)
            <option value="{{ $statusKey }}" @selected(old('status', $testimonial?->status ?? 'approved') === $statusKey)>{{ $statusLabel }}</option>
        @endforeach
    </select>
    @error('status')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>
