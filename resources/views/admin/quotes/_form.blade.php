@php($quote = $quote ?? null)

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

<div x-data="quoteItemsForm({ items: @js(old('items', $defaultItems)), taxRate: @js((float) old('tax_rate', $quote?->tax_rate ?? 23)), documentType: @js(old('document_type', $quote?->document_type ?? 'proforma')), issueDate: @js(old('issue_date', $quote?->issue_date?->format('d/m/Y') ?? now()->format('d/m/Y'))), dueDate: @js(old('due_date', $quote?->due_date?->format('d/m/Y'))) })">
<div class="grid gap-4 md:grid-cols-3">
    <div>
        <label class="mb-1 block text-sm font-medium" for="title">Título</label>
        <input id="title" name="title" required value="{{ old('title', $quote?->title) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('title'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('title')]) aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}">
        @error('title')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="status">Estado</label>
        <select id="status" name="status" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('status'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('status')]) aria-invalid="{{ $errors->has('status') ? 'true' : 'false' }}">
            @foreach ($statuses as $statusKey => $statusLabel)
                <option value="{{ $statusKey }}" @selected(old('status', $quote?->status ?? 'draft') === $statusKey)>{{ $statusLabel }}</option>
            @endforeach
        </select>
        @error('status')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="document_type">Tipo</label>
        <select id="document_type" name="document_type" x-model="documentType" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('document_type'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('document_type')]) aria-invalid="{{ $errors->has('document_type') ? 'true' : 'false' }}">
            @foreach ($documentTypes as $typeKey => $typeLabel)
                <option value="{{ $typeKey }}">{{ $typeLabel }}</option>
            @endforeach
        </select>
        @error('document_type')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4 grid grid-cols-1 gap-4" :class="documentType === 'proforma' ? 'md:grid-cols-2' : 'md:grid-cols-1'">
    <div>
        <label class="mb-1 block text-sm font-medium" for="issue_date">Data de emissão</label>
        <div class="relative">
            <input id="issue_date" type="text" inputmode="numeric" autocomplete="off" placeholder="dd/mm/aaaa" name="issue_date" required x-model="issueDate" @click="openPicker('issue')" @blur="normalizeDisplayDate('issue')" @class(['w-full rounded-xl border bg-white px-4 py-2.5 pr-10 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('issue_date'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('issue_date')]) aria-invalid="{{ $errors->has('issue_date') ? 'true' : 'false' }}">
            <button type="button" @click.prevent="openPicker('issue')" class="absolute inset-y-0 right-0 inline-flex w-10 items-center justify-center text-slate-500 transition hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200" aria-label="Escolher data de emissão">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            </button>
            <input x-ref="issuePicker" type="date" x-model="issueDateIso" @change="syncDisplayDate('issue')" class="pointer-events-none absolute h-0 w-0 opacity-0" tabindex="-1" aria-hidden="true">
        </div>
        @error('issue_date')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div x-show="documentType === 'proforma'" x-transition.opacity>
        <label class="mb-1 block text-sm font-medium" for="due_date">Data de validade</label>
        <div class="relative">
            <input id="due_date" type="text" inputmode="numeric" autocomplete="off" placeholder="dd/mm/aaaa" name="due_date" :required="documentType === 'proforma'" x-model="dueDate" @click="openPicker('due')" @blur="normalizeDisplayDate('due')" @class(['w-full rounded-xl border bg-white px-4 py-2.5 pr-10 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('due_date'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('due_date')]) aria-invalid="{{ $errors->has('due_date') ? 'true' : 'false' }}">
            <button type="button" @click.prevent="openPicker('due')" class="absolute inset-y-0 right-0 inline-flex w-10 items-center justify-center text-slate-500 transition hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200" aria-label="Escolher data de validade">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            </button>
            <input x-ref="duePicker" type="date" x-model="dueDateIso" @change="syncDisplayDate('due')" class="pointer-events-none absolute h-0 w-0 opacity-0" tabindex="-1" aria-hidden="true">
        </div>
        @error('due_date')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4 grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium" for="client_name">Cliente</label>
        <input id="client_name" name="client_name" required value="{{ old('client_name', $quote?->client_name) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('client_name'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('client_name')]) aria-invalid="{{ $errors->has('client_name') ? 'true' : 'false' }}">
        @error('client_name')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="client_email">Email</label>
        <input id="client_email" type="email" name="client_email" value="{{ old('client_email', $quote?->client_email) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('client_email'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('client_email')]) aria-invalid="{{ $errors->has('client_email') ? 'true' : 'false' }}">
        @error('client_email')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4 grid gap-4 md:grid-cols-3">
    <div>
        <label class="mb-1 block text-sm font-medium" for="client_phone">Telefone</label>
        <input id="client_phone" name="client_phone" value="{{ old('client_phone', $quote?->client_phone) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('client_phone'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('client_phone')]) aria-invalid="{{ $errors->has('client_phone') ? 'true' : 'false' }}">
        @error('client_phone')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="client_nif">NIF</label>
        <input id="client_nif" name="client_nif" value="{{ old('client_nif', $quote?->client_nif) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('client_nif'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('client_nif')]) aria-invalid="{{ $errors->has('client_nif') ? 'true' : 'false' }}">
        @error('client_nif')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="tax_rate">IVA (%)</label>
        <div class="number-stepper">
            <input id="tax_rate" type="number" step="0.01" min="0" max="100" name="tax_rate" value="{{ old('tax_rate', $quote?->tax_rate ?? '23.00') }}" x-model="taxRate" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('tax_rate'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('tax_rate')]) aria-invalid="{{ $errors->has('tax_rate') ? 'true' : 'false' }}">
            <div class="number-stepper-controls">
                <button type="button" class="number-stepper-btn" @click="taxRate = Math.min(100, (Number(taxRate || 0) + 0.5).toFixed(2))" aria-label="Aumentar IVA">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 14 6-6 6 6"/></svg>
                </button>
                <button type="button" class="number-stepper-btn" @click="taxRate = Math.max(0, (Number(taxRate || 0) - 0.5).toFixed(2))" aria-label="Diminuir IVA">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 10 6 6 6-6"/></svg>
                </button>
            </div>
        </div>
        @error('tax_rate')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4">
    <label class="mb-1 block text-sm font-medium" for="client_address">Morada</label>
    <input id="client_address" name="client_address" value="{{ old('client_address', $quote?->client_address) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('client_address'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('client_address')]) aria-invalid="{{ $errors->has('client_address') ? 'true' : 'false' }}">
    @error('client_address')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <div class="mb-3 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Linhas do orçamento</h2>
        <button type="button" class="btn-secondary" @click="addItem">Adicionar linha</button>
    </div>

    <div class="space-y-3">
        <template x-for="(item, index) in items" :key="index">
            <div class="grid gap-3 rounded-xl border border-[#a8b3c6] p-3 dark:border-[#4e576a] md:grid-cols-[1fr_120px_150px_auto]">
                <div>
                    <label class="mb-1 block text-xs font-medium">Descrição</label>
                    <input type="text" x-model="item.description" :name="`items[${index}][description]`" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium">Qtd.</label>
                    <div class="number-stepper">
                        <input type="number" step="0.01" min="0.01" x-model="item.quantity" :name="`items[${index}][quantity]`" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900">
                        <div class="number-stepper-controls">
                            <button type="button" class="number-stepper-btn" @click="item.quantity = (Math.max(0.01, Number(item.quantity || 0)) + 0.01).toFixed(2)" aria-label="Aumentar quantidade">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 14 6-6 6 6"/></svg>
                            </button>
                            <button type="button" class="number-stepper-btn" @click="item.quantity = Math.max(0.01, Number(item.quantity || 0) - 0.01).toFixed(2)" aria-label="Diminuir quantidade">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 10 6 6 6-6"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium">Preço unit.</label>
                    <div class="number-stepper">
                        <input type="number" step="0.01" min="0" x-model="item.unit_price" :name="`items[${index}][unit_price]`" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900">
                        <div class="number-stepper-controls">
                            <button type="button" class="number-stepper-btn" @click="item.unit_price = (Math.max(0, Number(item.unit_price || 0)) + 0.50).toFixed(2)" aria-label="Aumentar preço">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 14 6-6 6 6"/></svg>
                            </button>
                            <button type="button" class="number-stepper-btn" @click="item.unit_price = Math.max(0, Number(item.unit_price || 0) - 0.50).toFixed(2)" aria-label="Diminuir preço">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 10 6 6 6-6"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-md text-rose-600 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-900/20" @click="removeItem(index)" title="Remover linha">
                        <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                    </button>
                </div>
            </div>
        </template>
    </div>

    <div class="mt-4 flex justify-end">
        <div class="w-full max-w-xs space-y-2 text-sm">
            <div class="flex items-center justify-between"><span>Subtotal</span><strong x-text="formatCurrency(subtotal)"></strong></div>
            <div class="flex items-center justify-between"><span>IVA</span><strong x-text="formatCurrency(taxTotal)"></strong></div>
            <div class="flex items-center justify-between border-t border-[#a8b3c6] pt-2 text-base font-semibold dark:border-[#4e576a]"><span>Total</span><strong x-text="formatCurrency(total)"></strong></div>
        </div>
    </div>
</div>

</div>

<div class="mt-4">
    <label class="mb-1 block text-sm font-medium" for="notes">Notas</label>
    <textarea id="notes" name="notes" rows="4" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('notes'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('notes')]) aria-invalid="{{ $errors->has('notes') ? 'true' : 'false' }}">{{ old('notes', $quote?->notes) }}</textarea>
    @error('notes')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
<script>
function quoteItemsForm({ items, taxRate, documentType, issueDate, dueDate }) {
    return {
        items: Array.isArray(items) && items.length ? items : [{ description: '', quantity: '1.00', unit_price: '0.00' }],
        taxRate: Number(taxRate) || 0,
        documentType: documentType || 'proforma',
        issueDate: issueDate || '',
        dueDate: dueDate || '',
        issueDateIso: '',
        dueDateIso: '',
        init() {
            this.issueDateIso = this.toIso(this.issueDate);
            this.dueDateIso = this.toIso(this.dueDate);
        },
        addItem() {
            this.items.push({ description: '', quantity: '1.00', unit_price: '0.00' });
        },
        removeItem(index) {
            if (this.items.length === 1) {
                return;
            }
            this.items.splice(index, 1);
        },
        get subtotal() {
            return this.items.reduce((sum, item) => sum + (Number(item.quantity || 0) * Number(item.unit_price || 0)), 0);
        },
        get taxTotal() {
            return this.subtotal * (this.taxRate / 100);
        },
        get total() {
            return this.subtotal + this.taxTotal;
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('pt-PT', { style: 'currency', currency: 'EUR' }).format(value || 0);
        },
        openPicker(type) {
            const refName = type === 'issue' ? 'issuePicker' : 'duePicker';
            const picker = this.$refs[refName];

            if (!picker) {
                return;
            }

            if (typeof picker.showPicker === 'function') {
                picker.showPicker();
                return;
            }

            picker.focus();
            picker.click();
        },
        syncDisplayDate(type) {
            if (type === 'issue') {
                this.issueDate = this.fromIso(this.issueDateIso);
                return;
            }

            this.dueDate = this.fromIso(this.dueDateIso);
        },
        normalizeDisplayDate(type) {
            if (type === 'issue') {
                this.issueDateIso = this.toIso(this.issueDate);
                this.issueDate = this.fromIso(this.issueDateIso) || this.issueDate;
                return;
            }

            this.dueDateIso = this.toIso(this.dueDate);
            this.dueDate = this.fromIso(this.dueDateIso) || this.dueDate;
        },
        toIso(value) {
            const match = String(value || '').trim().match(/^(\d{2})\/(\d{2})\/(\d{4})$/);

            if (!match) {
                return '';
            }

            return `${match[3]}-${match[2]}-${match[1]}`;
        },
        fromIso(value) {
            const match = String(value || '').trim().match(/^(\d{4})-(\d{2})-(\d{2})$/);

            if (!match) {
                return '';
            }

            return `${match[3]}/${match[2]}/${match[1]}`;
        }
    }
}
</script>
@endpush
