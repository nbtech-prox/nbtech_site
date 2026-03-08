<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'status' => ['required', 'string', 'in:draft,emitted,paid,cancelled'],
            'document_type' => ['required', 'string', 'in:proforma,fatura-recibo'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:issue_date', 'required_if:document_type,proforma'],
            'client_name' => ['required', 'string', 'max:160'],
            'client_email' => ['nullable', 'email', 'max:160'],
            'client_phone' => ['nullable', 'string', 'max:40'],
            'client_nif' => ['nullable', 'string', 'max:40'],
            'client_address' => ['nullable', 'string', 'max:255'],
            'tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'issue_date' => $this->normalizeDate((string) $this->input('issue_date')),
            'due_date' => $this->normalizeDate((string) $this->input('due_date')),
        ]);
    }

    private function normalizeDate(string $value): ?string
    {
        $trimmed = trim($value);

        if ($trimmed === '') {
            return null;
        }

        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $trimmed) === 1) {
            try {
                return Carbon::createFromFormat('d/m/Y', $trimmed)->format('Y-m-d');
            } catch (\Throwable) {
                return $trimmed;
            }
        }

        return $trimmed;
    }
}
