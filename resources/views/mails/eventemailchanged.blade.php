@component('mail::message')
    Zdravím **{{$inputs["name"]}}**,  {{-- use double space for line break --}}
    Práve sa zmenili dáta na evente {{$inputs["event_name"]}} na ktorom ste prihlásený.
    Event začína {{\Carbon\Carbon::parse($inputs["start_date"])->format('d.m.Y H:i:s')}} a končí {{\Carbon\Carbon::parse($inputs["end_date"])->format('d.m.Y H:i:s')}}.
    Miesto konania je {{$inputs["event_place"]}}. Maximálny počet učastníkov konania je {{$inputs["max_percipient"]}}.
    @if($inputs["event_type"] == 2) Fakulta, ktorej event prislúcha je {{$inputs["fakulta"]}}.
    @elseif($inputs["event_type"] == 1) Katedra, ktorej event prislúcha je {{$inputs["katedra"]}}.
    @endif

    S pozdravom,
    SheduleTap.
@endcomponent
