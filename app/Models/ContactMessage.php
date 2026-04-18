<?php

namespace App\Models;

use App\Support\ContactMessageTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    private const PROJECT_TYPE_LABELS = [
        'website' => 'Website',
        'web-app' => 'Aplicacao web',
        'mobile-app' => 'Mobile app',
        'platform' => 'Plataforma',
        'automation' => 'Automacao',
        'other' => 'Outro',
    ];

    private const BUDGET_RANGE_LABELS = [
        'ate-1000' => 'Ate 1.000 EUR',
        '1000-2500' => '1.000-2.500 EUR',
        '2500-5000' => '2.500-5.000 EUR',
        '5000-10000' => '5.000-10.000 EUR',
        '10000-plus' => '10.000+ EUR',
    ];

    private const TIMELINE_LABELS = [
        'urgente' => 'Urgente',
        '30-60-dias' => '30-60 dias',
        '2-3-meses' => '2-3 meses',
        'flexivel' => 'Flexivel',
    ];

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'company',
        'type',
        'phone',
        'project_type',
        'budget_range',
        'timeline',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function typeLabel(): string
    {
        return ContactMessageTypes::labels()[$this->type] ?? ucfirst((string) $this->type);
    }

    public function projectTypeLabel(): string
    {
        return self::PROJECT_TYPE_LABELS[$this->project_type] ?? (string) $this->project_type;
    }

    public function budgetRangeLabel(): string
    {
        return self::BUDGET_RANGE_LABELS[$this->budget_range] ?? (string) $this->budget_range;
    }

    public function timelineLabel(): string
    {
        return self::TIMELINE_LABELS[$this->timeline] ?? (string) $this->timeline;
    }
}
