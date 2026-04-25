@component('mail::message')
# Novo pedido de orçamento

Recebeste um novo pedido de orçamento através do site NBTech.

@component('mail::panel')
**Nome:** {{ $message->name }}  
**Email:** {{ $message->email }}  
**Empresa:** {{ $message->company ?: '—' }}  
**Telefone:** {{ $message->phone ?: '—' }}  
**Tipo de projeto:** {{ $message->projectTypeLabel() }}  
**Faixa de investimento:** {{ $message->budgetRangeLabel() }}  
**Prazo pretendido:** {{ $message->timelineLabel() }}
@endcomponent

## Descrição do objetivo

{{ $message->message }}

@component('mail::button', ['url' => route('admin.messages.show', $message)])
Ver no painel admin
@endcomponent

Obrigado,  
{{ config('app.name') }}
@endcomponent
