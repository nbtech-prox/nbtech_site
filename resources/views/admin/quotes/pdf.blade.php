<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>{{ $documentType }} {{ $documentNumber }}</title>
    <style>
        @font-face {
            font-family: 'Baloo2PdfLocal';
            src: url('file://{{ public_path("branding/fonts/Baloo2-500.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Baloo2PdfLocal';
            src: url('file://{{ public_path("branding/fonts/Baloo2-700.ttf") }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        @font-face {
            font-family: 'GugiPdf';
            src: url('file://{{ public_path("branding/fonts/Gugi-Regular.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body { margin: 0; font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 12px; line-height: 1.45; }
        .page { padding: 24px 28px; }
        .top { width: 100%; border-collapse: collapse; table-layout: fixed; margin-bottom: 32px; }
        .top td { vertical-align: top; }
        .brand-cell { width: 54%; }
        .doc-cell { width: 46%; padding-left: 24px; }
        .brand-panel { display: inline-block; }
        .brand-lockup { width: 350px; height: auto; display: block; }
        .brand-meta { margin-top: 8px; margin-left: 12px; font-size: 11px; color: #334155; }
        .doc-title { text-align: left; margin-top: 12px; }
        .doc-title p { margin: 0; }
        .doc-label { font-size: 21px; font-weight: 700; letter-spacing: .2px; }
        .doc-number { margin-top: 3px; font-size: 12px; font-weight: 600; }
        .meta-row { margin-top: 2px; font-size: 11px; color: #4b5563; }
        .section-title { margin: 0 0 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #374151; }
        .parties { width: 100%; border-collapse: separate; border-spacing: 0; margin: 0 0 16px; }
        .parties td { vertical-align: top; padding: 10px 12px; border: none; }
        .parties .left-col { width: 54%; }
        .parties .right-col { width: 46%; padding-left: 24px; }
        .parties td + td { border-left: none; }
        .parties p { margin: 0 0 4px; }
        .parties p:last-child { margin-bottom: 0; }
        .doc-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .doc-table col.col-description { width: 46%; }
        .doc-table col.col-metric { width: 18%; }
        .doc-table th { text-align: left; padding: 8px 10px; background: #f3f4f6; border: none; font-size: 11px; }
        .doc-table td { padding: 8px 10px; border: none; }
        .right { text-align: right; }
        .center { text-align: center; }
        .doc-table th.center,
        .doc-table td.center,
        .doc-table th:nth-child(n+2),
        .doc-table td:nth-child(n+2) {
            padding-left: 0;
            padding-right: 0;
            text-align: center;
        }
        .column-align-box {
            display: block;
            width: 130px;
            margin: 0 auto;
        }
        .column-align-box.center-text { text-align: center; }
        .column-align-box.left-text { text-align: left; }
        .doc-table .totals-row td { padding-top: 2px; padding-bottom: 2px; }
        .doc-table .totals-row-start td { padding-top: 14px; }
        .doc-table .totals-label,
        .doc-table .totals-value { text-align: center; }
        .doc-table .totals-final td { padding-top: 4px; font-weight: 700; }
        .notes { margin-top: 16px; border: none; padding: 10px 12px; }
        .notes p { margin: 6px 0 0; }
        .conditions { margin-top: 14px; padding: 0 12px; font-size: 10.5px; color: #374151; }
        .iban-row { margin-top: 16px; padding: 0 12px; font-size: 11px; color: #4b5563; }
        .footer { margin-top: 16px; padding: 8px 12px 0; border-top: none; font-size: 10px; color: #6b7280; }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('branding/logo/logo-clean.png');
        $logoDataUri = file_exists($logoPath)
            ? 'data:image/png;base64,'.base64_encode((string) file_get_contents($logoPath))
            : null;
        $lockupPath = public_path('branding/logo/nbtech-lockup.png');
        $lockupDataUri = file_exists($lockupPath)
            ? 'data:image/png;base64,'.base64_encode((string) file_get_contents($lockupPath))
            : null;
        $issueDateLong = $quote->issue_date?->locale('pt_PT')->translatedFormat('d \d\e F \d\e Y') ?? $quote->issue_date?->format('d/m/Y');
        $generatedAtLong = $generatedAt->locale('pt_PT')->translatedFormat('d \d\e F \d\e Y, H:i');
        $dueDateLong = $quote->due_date?->locale('pt_PT')->translatedFormat('d \d\e F \d\e Y') ?? $quote->due_date?->format('d/m/Y');
        $documentShort = match ($documentType) {
            'Fatura Proforma' => 'PROFORMA',
            'Fatura/Recibo' => 'FATURA/RECIBO',
            default => 'ORÇAMENTO',
        };
        $validityLabel = $documentType === 'Orçamento' ? 'Válido até' : 'Vencimento';
        $legalLine = match ($documentType) {
            'Fatura/Recibo' => 'Documento emitido por meios eletrónicos, nos termos legais em vigor. Pagamento liquidado na data de emissão.',
            'Fatura Proforma' => 'Documento sem valor fiscal. Ao aceitar esta proposta, deverá ser efetuado um pagamento inicial mínimo de 50% do valor total. A emissão da fatura/recibo final ocorre após confirmação de pagamento.',
            default => 'Documento de proposta comercial sem valor fiscal. A faturação final será emitida após adjudicação.',
        };
    @endphp

    <div class="page">
    <table class="top" role="presentation">
        <tr>
            <td class="brand-cell">
                <div class="brand-panel">
                    @if ($lockupDataUri)
                        <img src="{{ $lockupDataUri }}" alt="NBTech" class="brand-lockup">
                    @elseif ($logoDataUri)
                        <img src="{{ $logoDataUri }}" alt="NBTech" class="brand-lockup" style="width: 84px;">
                    @endif
                </div>
                <p class="brand-meta">{{ $company['legal_name'] ?? $company['name'] }} · NIF: {{ $company['nif'] ?? '—' }}</p>
            </td>
            <td class="doc-cell">
                <div class="doc-title">
                    <p class="doc-label">{{ $documentShort }}</p>
                    <p class="doc-number">N.º {{ $documentNumber }}</p>
                    <p class="meta-row">Data de emissão: {{ $issueDateLong }}</p>
                    <p class="meta-row">Gerado em: {{ $generatedAtLong }}</p>
                    @if ($documentType === 'Fatura Proforma' && $dueDateLong)
                        <p class="meta-row">{{ $validityLabel }}: {{ $dueDateLong }}</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table class="parties" role="presentation">
        <tr>
            <td class="left-col">
                <p class="section-title">Emitente</p>
                <p>{{ $company['legal_name'] ?? $company['name'] }}</p>
                <p>{{ $company['address'] ?? '—' }}</p>
                <p>{{ $company['email'] ?? '—' }}@if (!empty($company['phone'])) · {{ $company['phone'] }}@endif</p>
            </td>
            <td class="right-col">
                <p class="section-title">Cliente</p>
                <p>{{ $quote->client_name }}</p>
                @if ($quote->client_address)<p>{{ $quote->client_address }}</p>@endif
                @if ($quote->client_nif)<p>NIF: {{ $quote->client_nif }}</p>@endif
                @if ($quote->client_email || $quote->client_phone)
                    <p>{{ $quote->client_email ?: '—' }}@if ($quote->client_phone) · {{ $quote->client_phone }}@endif</p>
                @endif
            </td>
        </tr>
    </table>

    <table class="doc-table">
        <colgroup>
            <col class="col-description">
            <col class="col-metric">
            <col class="col-metric">
            <col class="col-metric">
        </colgroup>
        <thead>
            <tr>
                <th class="col-description">Descrição</th>
                <th class="center col-metric"><span class="column-align-box center-text">Quantidade</span></th>
                <th class="center col-metric">Preço Unit.</th>
                <th class="center col-metric">Total Linha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quote->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="center">{{ number_format((float) $item->quantity, 2, ',', '.') }}</td>
                    <td class="center">€ {{ number_format((float) $item->unit_price, 2, ',', '.') }}</td>
                    <td class="center">€ {{ number_format((float) $item->line_total, 2, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr class="totals-row totals-row-start">
                <td></td>
                <td></td>
                <td class="totals-label"><span class="column-align-box left-text">Subtotal</span></td>
                <td class="totals-value">€ {{ number_format((float) $quote->subtotal, 2, ',', '.') }}</td>
            </tr>
            <tr class="totals-row">
                <td></td>
                <td></td>
                <td class="totals-label"><span class="column-align-box left-text">IVA ({{ number_format((float) $quote->tax_rate, 2, ',', '.') }}%)</span></td>
                <td class="totals-value">€ {{ number_format((float) $quote->tax_total, 2, ',', '.') }}</td>
            </tr>
            <tr class="totals-row totals-final">
                <td></td>
                <td></td>
                <td class="totals-label"><span class="column-align-box left-text">Total</span></td>
                <td class="totals-value">€ {{ number_format((float) $quote->total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    @if ($quote->notes)
        <div class="notes">
            <strong>Notas</strong>
            <p>{{ $quote->notes }}</p>
        </div>
    @endif

    <div class="conditions">
        <strong>Condições:</strong> {{ $legalLine }}
    </div>

    @if (!empty($company['iban']))
        <p class="iban-row">IBAN para pagamento: {{ $company['iban'] }}</p>
    @endif

    <div class="footer">
        {{ $company['legal_name'] ?? $company['name'] }} · NIF {{ $company['nif'] ?? '—' }}
    </div>
    </div>
</body>
</html>
