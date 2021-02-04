@component('mail::message')
# Olá, {{ $user->name }}! 😃

Seu código de alteração de senha é: <p style="padding:20px;background-color:#039BE5;color:#fff;font-weight:500;border-radius:4px;">{{ $user->token->token }}</div>

Agradecemos por fazer parte,<br>
{{ config('app.name') }}
@endcomponent
