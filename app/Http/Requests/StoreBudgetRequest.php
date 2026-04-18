<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'company' => ['nullable', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'project_type' => ['required', 'string', 'in:website,web-app,mobile-app,platform,automation,other'],
            'budget_range' => ['required', 'string', 'in:ate-1000,1000-2500,2500-5000,5000-10000,10000-plus'],
            'timeline' => ['required', 'string', 'in:urgente,30-60-dias,2-3-meses,flexivel'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
