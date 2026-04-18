<?php

namespace App\Support;

class QuoteStatuses
{
    public const DRAFT = 'draft';

    public const EMITTED = 'emitted';

    public const PAID = 'paid';

    public const CANCELLED = 'cancelled';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return [
            self::DRAFT,
            self::EMITTED,
            self::PAID,
            self::CANCELLED,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::DRAFT => 'Rascunho',
            self::EMITTED => 'Emitido',
            self::PAID => 'Pago',
            self::CANCELLED => 'Cancelado',
        ];
    }
}
