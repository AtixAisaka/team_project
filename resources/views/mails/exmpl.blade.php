@component('mail::message')
    Zdravím **{{$name}}**,  {{-- use double space for line break --}}
    Práve ste sa prihlásili na event {{$inputs["event_name"]}}.
    Event začína {{$inputs["start_date"]}} a končí {{$inputs["end_date"]}}.
    Miesto konania je {{$inputs["event_place"]}}.

    S pozdravom,
    SheduleTap.
@endcomponent
