@extends("layouts.app")
@section('content')
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    </head>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="breadcrumb">
                    <table>
                        <tr>
                            <td> <h3>Názov: {{$event->event_name}}</h3></td>
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
                            @if(Auth::User()->id == $eventImage->user_id || Auth::User()->role == 4)
                                <td>
                                    <a class="btn btn-primary btn" href="{{ action("EventsController@deleteImage",
                                        ["id" => $eventImage->id], ["eventid" => $event->eventid, "param" => $param,
                                         "userid" => $userid, "admin" => $admin]) }}" role="button">Vymazať</a>
                                </td>
                            @endif
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
                    ["value" => $param, "id" => $userid, "admin" => $admin])  }}" role="button">Späť</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{route('eventlist') }}" role="button">Späť</a>
            @endif
        </div>
    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
