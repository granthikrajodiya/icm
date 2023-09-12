@component('mail::message')
Hi {{ $user->name }},
This is your two-factor authentication code for ILINX Engage:

# {{ $code }}

Thanks,
The {{ config('app.name') }} team.
@endcomponent
