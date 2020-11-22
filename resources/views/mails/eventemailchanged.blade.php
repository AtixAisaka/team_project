@component('mail::message')
    Zdravím **{{$inputs["name"]}}**,  {{-- use double space for line break --}}
    Práve sa zmenili dáta na evente {{$inputs["event_name"]}} na ktorom ste prihlásený.
    Event začína {{$inputs["start_date"]}} a končí {{$inputs["end_date"]}}.
    Miesto konania je {{$inputs["event_place"]}}. Maximálny počet učastníkov konania je {{$inputs["max_percipient"]}}.
    @if($inputs["event_type"] == 2) Fakulta, ktorej event prislúcha je {{$inputs["fakulta"]}}.
    @elseif($inputs["event_type"] == 1) Katedra, ktorej event prislúcha je {{$inputs["katedra"]}}.
    @endif

    S pozdravom,
    SheduleTap.
@endcomponent
