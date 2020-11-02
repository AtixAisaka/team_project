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
                                    <td>
                                        <form action="{{ action("EventsController@showEventInfo") }}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="id" value="{{$event->id}}">
                                            <input type="hidden" name="helper" value="1">
                                            <input type="hidden" name="param" value="{{$param}}">
                                            <input type="submit" name="submit" value="Detaily"><br>
                                        </form>
                                    </td>
                                </tr>
                                @break
                            @endif
                        @endforeach
                    @endforeach
                </table>
            </div>
            <div class="col text-center">
                <a class="btn btn-primary btn-lg" href="{{ route('eventlist') }}" role="button">Späť</a>
            </div>
        </div>



        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
