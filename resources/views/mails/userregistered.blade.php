@component('mail::message')
    <div style="min-height: 300px">
        <p style="font-size: 25px">Zdravím {{$inputs["name"]}},</p>
        <p style="font-size: 17px">
            Práve ste úspešne zaregistrovali na stránku SheduleTap. .<br>
            Teraz si môžete pridávať vlastné eventy.<br>
            S pozdravom, SheduleTap.
        </p>
    </div>
@endcomponent
