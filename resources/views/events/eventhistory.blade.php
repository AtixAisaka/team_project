@extends("layouts.app")
@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin_event_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/event_list.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--    OLD Can be deleted!!!-->

    {{--    <div class="container">

                <li class="table-header">
                    <div class="col col-1">Názov</div>
                    <div class="col col-2">Začiatok eventu</div>
                    <div class="col col-3">Koniec eventu</div>
                    <div class="col col-4"></div>
                </li>
                            @foreach($allevents as $row)
                            <li class="table-row">
                                <div class="col col-1">{{$row-> event_name}}</div>
                                <div class="col col-2">{{$row-> start_date}}</div>
                                <div class="col col-3">{{$row-> end_date}}</div>
                                <div class="col col-4">
                                    <a class="btn-1" href="{{ action("EventsController@showEventInfo",
                                                ["id" => $row->id, "param" => $param, "userid" => $id, "admin" => $admin]) }}" role="button" >Detaily</a>

                                    @if(Auth::user()->role==4 || $param == 0)
                                        | <a class="btn-1" href="{{ action("EventsController@showEditEvent",
                                            ["id" => $row->id, "param" => $param, "userid" => $id, "admin" => $admin])  }}" role="button">Editovať</a>

                                            <form action="{{ action("EventsController@deleteUserGoingEvent") }}" method="POST" style="display: inline">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="eventid" value="{{$row->id}}">
                                                <input type="hidden" name="userid" value="{{$row->userid}}">
                                                <input type="hidden" name="value" value="{{$param}}">
                                                <input type="hidden" name="admin" value="{{$admin}}">
                                                | <input class="btn-1" style="background-color: white; border: white; color: rgb(30, 144, 255);width: auto" type="submit" name="submit" value="Mazať">
                                            </form>
                                    @endif
                                </div>
                            @endforeach

            </div>--}}

<div class="container">
    <div>
        @foreach($allevents as $event)
                <div class="gallery">
                    <div class="event_preview"><img src="{{asset('img/calendar_icon.png')}}"></div>
                    <div class="event_description">
                        <div style="font-size: 20px; font-weight: bold; " >{{$event-> event_name}}</div>
                        <strong>Začiatok eventu: </strong>{{$event-> start_date}}<br><strong>Koniec eventu: </strong>{{$event-> end_date}}
                    </div>

                    <div class="event_buttons">
                        <a class="btn-1" href="{{ action("EventsController@showEventInfo",
                                            ["id" => $event->id, "param" => $param, "userid" => $id, "admin" => $admin]) }}" role="button" >
                            <div class="valign-center"> <i class="material-icons">
                                    help_outline </i> Detaily
                            </div></a>
                            @if(Auth::user()->role==4 || $param == 0)
                                | <a class="btn-1" href="{{ action("EventsController@showEditEvent",
                                        ["id" => $event->id, "param" => $param, "userid" => $id, "admin" => $admin])  }}" role="button">
                                    <div class="valign-center"> <i class="material-icons">
                                            build </i> Editovať
                                    </div></a>
                                <form action="{{ action("EventsController@deleteUserGoingEvent") }}" method="POST" style="display: inline">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="eventid" value="{{$event->id}}">
                                    <input type="hidden" name="userid" value="{{$event->userid}}">
                                    <input type="hidden" name="value" value="{{$param}}">
                                    <input type="hidden" name="admin" value="{{$admin}}">
                                    |
<!--                                    <input class="btn-1" style="background-color: white; border: white;
                                    color: rgb(30, 144, 255);width: auto" type="submit" name="submit" value="Mazať">-->
                                    <button class="btn-1" type="submit" name="submit" style="width: auto;background-color: rgba(225, 225, 225, .0); border: rgba(225, 225, 225, .0);">
                                        <div class="valign-center"> <i class="material-icons">
                                                delete </i> Mazať
                                        </div>
                                    </button>

                                </form>
                            @endif
                    </div>
                </div>
        @endforeach
    </div>
</div>


<br>
    <div class="container" style=" display: flex; justify-content: center; align-items: center; ">

        @if($admin != -1)
            <a class="btn effect01" style="width: 100px;" href="{{action("UsersController@showUserList")}}" role="button">Späť</a>
        @else
            <a class="btn effect01" style="width: 100px;" href="{{ route('eventlist') }}" role="button">Späť</a>
        @endif

    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
