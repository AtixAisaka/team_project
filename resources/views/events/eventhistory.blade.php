@extends("layouts.app")
@section('content')
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>

    <div class="container">
        <div class="jumbotron">
                <table>
                    @foreach($events as $event)
                        @foreach($allevents as $row)
                            @if($event->eventid == $row->id)
                                <tr>
                                    <td> Meno: {{$row-> event_name}}, &nbsp; </td>
                                    <td> Od: {{$row-> start_date}}, &nbsp; Do: {{$row-> end_date}}.</td>

                                    @if(Auth::user()->role==4)
                                        <td>
                                            <a class="btn btn-primary btn" href="{{ action("EventsController@showEditEvent",
                                        ["id" => $event->eventid, "param" => $param, "userid" => $id, "admin" => $admin])  }}" role="button">Editovať</a>
                                        </td>
                                        <td>
                                            <form action="{{ action("EventsController@deleteUserGoingEvent") }}" method="POST">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="eventid" value="{{$event->eventid}}">
                                                <input type="hidden" name="userid" value="{{$event->userid}}">
                                                <input type="hidden" name="value" value="{{$param}}">
                                                <input type="hidden" name="admin" value="{{$admin}}">
                                                <input type="submit" name="submit" value="Mazať"><br>
                                            </form>
                                        </td>
                                    @endif

                                    <td>
                                        <a class="btn btn-primary btn" href="{{ action("EventsController@showEventInfo",
                                            ["id" => $event->eventid, "param" => $param, "userid" => $id, "admin" => $admin]) }}" role="button">Detaily</a>
                                    </td>
                                </tr>
                                @break
                            @endif
                        @endforeach
                    @endforeach
                </table>
            </div>
            <div class="col text-center">
                @if($admin != -1)
                    <a class="btn btn-primary btn-lg" href="{{action("UsersController@showUserList")}}" role="button">Späť</a>
                @else
                    <a class="btn btn-primary btn-lg" href="{{ route('eventlist') }}" role="button">Späť</a>
                @endif
            </div>
        </div>



        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
