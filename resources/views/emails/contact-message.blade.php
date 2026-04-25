@component('mail::message')
# Novo contacto recebido

Recebeste uma nova mensagem através do formulário de contacto do site NBTech.

@component('mail::panel')
**Nome:** {{ $message->name }}  
**Email:** {{ $message->email }}  
**Empresa:** {{ $message->company ?: '—' }}  
**Tipo:** {{ $message->typeLabel() }}
@endcomponent

## Mensagem

{{ $message->message }}

@component('mail::button', ['url' => route('admin.messages.show', $message)])
Ver no painel admin
@endcomponent

Obrigado,  
{{ config('app.name') }}
@endcomponent
