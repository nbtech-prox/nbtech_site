<?php

namespace App\Support;

class QuoteDocumentTypes
{
    public const PROFORMA = 'proforma';

    public const INVOICE_RECEIPT = 'fatura-recibo';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return [
            self::PROFORMA,
            self::INVOICE_RECEIPT,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROFORMA => 'Fatura Proforma',
            self::INVOICE_RECEIPT => 'Fatura/Recibo',
        ];
    }
}
