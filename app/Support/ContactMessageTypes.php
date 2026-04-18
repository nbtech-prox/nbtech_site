<?php

namespace App\Support;

class ContactMessageTypes
{
    public const CONTACT = 'contact';

    public const BUDGET = 'budget';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return [
            self::CONTACT,
            self::BUDGET,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::CONTACT => 'Contacto geral',
            self::BUDGET => 'Pedido de orçamento',
        ];
    }
}
