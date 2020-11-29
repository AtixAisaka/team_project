@extends("layouts.app")
@section('content')

    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin_event_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/event_list.css')}}">

    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container">
    <div>
        @foreach($allevents as $event)
                <div class="gallery">
                    <div class="event_preview"><img src="{{asset('img/calendar_icon.png')}}"></div>
                    <div class="event_description">
                        <div style="font-size: 20px; font-weight: bold; " >{{$event-> event_name}}</div>
                        <strong>Začiatok eventu: </strong>{{\Carbon\Carbon::parse($event->start_date)->format('d.m.Y H:i:s')}}<br>
                        <strong>Koniec eventu: </strong>{{\Carbon\Carbon::parse($event->end_date)->format('d.m.Y H:i:s')}}
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
            <a class="btn effect01" style="width: 100px;" href="{{action("UsersController@showFilters")}}" role="button">Späť</a>
        @else
            <a class="btn effect01" style="width: 100px;" href="{{ route('eventlist') }}" role="button">Späť</a>
        @endif

    </div>

@endsection
