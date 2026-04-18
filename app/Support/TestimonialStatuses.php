<?php

namespace App\Support;

class TestimonialStatuses
{
    public const PENDING = 'pending';

    public const APPROVED = 'approved';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return [
            self::PENDING,
            self::APPROVED,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PENDING => 'Pendente',
            self::APPROVED => 'Aprovado',
        ];
    }
}
