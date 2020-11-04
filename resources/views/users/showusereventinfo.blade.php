@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="breadcrumb">
                    <table>
                        <tr>
                            <td> <h3>Meno: {{$user->name}}</h3></td>
                        </tr>
                        <tr>
                            <td><h3>Zakladatel: {{$eventowner}} </h3></td>
                        </tr>
                        <tr>
                            <td><h3>Od: {{$event->start_date}} </h3></td>
                        </tr>
                        <tr>
                            <td><h3>Do: {{$event->end_date}} </h3></td>
                        </tr>
                        <tr>
                            <td> <h3>Počet zúčastnených: {{$count}}</h3></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col">
                <div class="breadcrumb">
                    <table>
                        <tr>
                            <td class="text-center"><h3>Mená zúčastených: </h3></td>
                        </tr>
                        <tr>
                            <td><h3>{{$usersgoing}}</h3></td>
                        </tr>
                    </table>
                </div>
            </div>
            @auth
            @if($value == 1)
            <div class="col">
                <div class="breadcrumb">
                    <table>

                        <tr>
                            <td class="text-center"><a href="{{ action("EventsController@openImageUpload", ["id" => $event->id]) }}">Upload Obrázkov</a><h3>Obrázky udalosti: </h3></td>
                        </tr>
                        @foreach($eventsImages as $eventImage)
                        <tr>
                            <td><img width="250px" src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
            @endauth
        </div>
        <div class="col text-center">
            @if($param != -1)
                <a class="btn btn-primary btn-lg" href="{{ action("EventsController@showEventsHistory",
                    ["value" => $param, "id" => Auth::user()->id, "admin" => $admin])  }}" role="button">Späť</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{route('eventlist') }}" role="button">Späť</a>
            @endif
        </div>
    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
