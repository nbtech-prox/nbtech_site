<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'proforma_number',
        'invoice_receipt_number',
        'title',
        'status',
        'document_type',
        'issue_date',
        'due_date',
        'client_name',
        'client_email',
        'client_phone',
        'client_nif',
        'client_address',
        'tax_rate',
        'subtotal',
        'tax_total',
        'total',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
            'tax_rate' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'tax_total' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class)->orderBy('position');
    }
}
