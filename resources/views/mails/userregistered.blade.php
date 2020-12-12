@component('mail::message')
    <div>
        <p style="font-size: 25px">Zdravím {{$inputs["name"]}},</p>
        <p style="font-size: 17px">
            Práve ste sa úspešne zaregistrovali na stránku SheduleTap.<br>
            Teraz si môžete pridávať vlastné eventy.<br>
        </p>
    </div>
    S pozdravom,
    SheduleTap.
@endcomponent
