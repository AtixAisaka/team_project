@component('mail::message')
    <div style="min-height: 300px">
        <p style="font-size: 25px">Zdravím {{$name}},</p>
        <p style="font-size: 17px">
            Práve ste založili event <strong>{{$inputs["event_name"]}}</strong>.<br>
            Event začína <strong>{{\Carbon\Carbon::parse($inputs["start_date"])->format('d.m.Y H:i:s')}}</strong> a končí
            <strong>{{\Carbon\Carbon::parse($inputs["end_date"])->format('d.m.Y H:i:s')}}</strong>.<br>
            Miesto konania je <strong>{{$inputs["event_place"]}}</strong>.<br><br>
            S pozdravom, SheduleTap.
        </p>
    </div>
@endcomponent
