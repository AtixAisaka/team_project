@component('mail::message')
    Zdravím **{{$inputs["name"]}}**,  {{-- use double space for line break --}}
    Práve sa zmenili dáta na evente <strong>{{$inputs["event_name"]}}</strong> na ktorom ste prihlásený.
    Event začína <strong>{{\Carbon\Carbon::parse($inputs["start_date"])->format('d.m.Y H:i:s')}}</strong> a
    končí <strong>{{\Carbon\Carbon::parse($inputs["end_date"])->format('d.m.Y H:i:s')}}</strong>.
    Miesto konania je <strong>{{$inputs["event_place"]}}</strong>. Maximálny počet učastníkov konania je <strong>{{$inputs["max_percipient"]}}</strong>.
    @if($inputs["event_type"] == 2) Fakulta, ktorej event prislúcha je <strong>{{$inputs["fakulta"]}}</strong>.
    @elseif($inputs["event_type"] == 1) Katedra, ktorej event prislúcha je <strong>{{$inputs["katedra"]}}</strong>.
    @endif

    S pozdravom,
    SheduleTap.
@endcomponent
