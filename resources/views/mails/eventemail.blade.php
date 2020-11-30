@component('mail::message')
    <div style="min-height: 300px">
        <p style="font-size: 25px">Zdravím {{$name}},</p>
        <p style="font-size: 17px">
            Práve ste sa prihlásili na event <strong>{{$inputs["event_name"]}}</strong>.<br>
            Event začína <strong>{{$inputs["start_date"]}}</strong> a končí <strong>{{$inputs["end_date"]}}</strong>.<br>
            Miesto konania je <strong>{{$inputs["event_place"]}}</strong>.<br><br>
            S pozdravom, SheduleTap.
        </p>
    </div>
@endcomponent
