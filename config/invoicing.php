<?php

return [
    'company' => [
        'name' => env('INVOICE_COMPANY_NAME', 'NBTech'),
        'legal_name' => env('INVOICE_COMPANY_LEGAL_NAME', 'NBTech, Lda.'),
        'nif' => env('INVOICE_COMPANY_NIF', 'PT000000000'),
        'address' => env('INVOICE_COMPANY_ADDRESS', 'Rua Exemplo 123, 1000-000 Lisboa'),
        'email' => env('INVOICE_COMPANY_EMAIL', 'financeiro@nbtech.pt'),
        'phone' => env('INVOICE_COMPANY_PHONE', '+351 000 000 000'),
        'iban' => env('INVOICE_COMPANY_IBAN', 'PT50 0000 0000 0000 0000 0000 0'),
    ],
];
