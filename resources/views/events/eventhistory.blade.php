@extends("layouts.app")
@section('content')

    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin_event_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/event_list.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
        function myFunction(f) {
            f.classList.toggle("fa-bars");

            var x = document.getElementById("myDIV");
            var y = document.getElementById("konec");
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
            if ($(this).find('i').text() === 'build'){
                $(this).find('i').text('delete');
            } else {
                $(this).find('i').text('build');
            }
        }
    </script>

<div class="container">

        <div style="width: 50px; border-right: 3px solid #474747; height: 50px">
            <div style="font-size: 43px">
                <i onclick="myFunction(this)" class="fa fa-th-large"></i>
            </div>
        </div>



        <div id="konec" style="display: none">
            <br>

                <li class="table-header">
                    <div class="col col-1">Názov</div>
                    <div class="col col-2">Začiatok eventu</div>
                    <div class="col col-3">Koniec eventu</div>
                    <div class="col col-4"></div>
                </li>
                            @foreach($allevents as $row)
                            <li class="table-row">
                                <div class="col col-1">{{$row-> event_name}}</div>
                                <div class="col col-2"></strong>{{\Carbon\Carbon::parse($row->start_date)->format('d.m.Y H:i:s')}}</div>
                                <div class="col col-3"></strong>{{\Carbon\Carbon::parse($row->end_date)->format('d.m.Y H:i:s')}}</div>
                                <div class="col col-4">
                                    <a class="btn-1" href="{{ action("EventsController@showEventInfo",
                                                ["id" => $row->id, "param" => $param, "userid" => $id, "admin" => $admin]) }}" role="button" >Detaily</a>

                                         @if($param == 0)
                                            @if(\Carbon\Carbon::parse($row->start_date)->isFuture() || Auth::user()->role==4)
                                                | <a class="btn-1" href="{{ action("EventsController@showEditEvent",
                                                    ["id" => $row->id, "param" => $param, "userid" => $id, "admin" => $admin])  }}" role="button">Editovať</a>
                                            @endif
                                         @endif
                                            <form action="{{ action("EventsController@deleteEventHistory") }}" method="POST" style="display: inline">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="eventid" value="{{$row->id}}">
                                                <input type="hidden" name="userid" value="{{$id}}">
                                                <input type="hidden" name="value" value="{{$param}}">
                                                <input type="hidden" name="admin" value="{{$admin}}">
                                                @if(\Carbon\Carbon::parse($row->start_date)->isFuture() || Auth::user()->role==4)
                                                    @if($param == 0)
                                                        | <input class="btn-1" style="background-color: white; border: white; color: rgb(76, 175, 80);width: auto" type="submit" name="submit" value="Mazať">
                                                    @elseif($param == 1)
                                                        | <input class="btn-1" style="background-color: white; border: white; color: rgb(76, 175, 80);width: auto" type="submit" name="submit" value="Zrušiť účasť">
                                                    @endif
                                                @endif
                                            </form>
                                </div>
                            @endforeach

            </div>

    <div id="myDIV">
        @foreach($allevents as $event)
                <div class="gallery">
                    <div class="event_preview" style="position: relative">
                        <form action="{{ action("EventsController@deleteEventHistory") }}" method="POST" style="display: inline">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="eventid" value="{{$event->id}}">
                            <input type="hidden" name="userid" value="{{$id}}">
                            <input type="hidden" name="value" value="{{$param}}">
                            <input type="hidden" name="admin" value="{{$admin}}">
                            <!--                                    <input class="btn-1" style="background-color: white; border: white;
                                                                color: rgb(30, 144, 255);width: auto" type="submit" name="submit" value="Mazať">-->
                            @if(\Carbon\Carbon::parse($event->start_date)->isFuture() || Auth::user()->role==4)

                        <div class="event_buttons_part1">
                            @if($param == 0)
                                    <a class="btn-1" href="{{ action("EventsController@showEditEvent",["id" => $event->id, "param" => $param, "userid" => $id, "admin" => $admin])  }}" role="button">
                                        <div class="valign-center"> <i class="material-icons">build</i></div>
                                    </a>
                                    <button class="btn-1" type="submit" name="submit" style="width: auto;background-color: rgba(225, 225, 225, .0); border: rgba(225, 225, 225, .0);">
                                        <div class="valign-center"><i class="material-icons">delete</i></div>
                                    </button>
                            @endif

                        </div>
                        <div class="event_buttons_part2">
                            <a class="btn-1" href="{{ action("EventsController@showEventInfo",["id" => $event->id, "param" => $param, "userid" => $id, "admin" => $admin]) }}" role="button" >
                                <div class="valign-center"><i class="material-icons">help_outline</i></div>
                            </a>
                            @if($param == 1)
                                <button class="btn-1" type="submit" name="submit" style="width: auto;background-color: rgba(225, 225, 225, .0); border: rgba(225, 225, 225, .0);">
                                    <div class="valign-center"><i class="material-icons">cancel</i></div>
                                </button>
                            @endif
                        </div>
                            @endif
                        </form>
                        <a href="{{ action("EventsController@showEventInfo",["id" => $event->id, "param" => $param, "userid" => $id, "admin" => $admin]) }}"><img src="{{asset('img/meeting.jpg')}}"></a>
                    </div>
                    <div class="event_description">
                        <div style="font-size: 20px; font-weight: bold; " >{{$event-> event_name}}</div>
                        <strong>Začiatok eventu: </strong>{{\Carbon\Carbon::parse($event->start_date)->format('d.m.Y H:i:s')}}<br>
                        <strong>Koniec eventu: </strong>{{\Carbon\Carbon::parse($event->end_date)->format('d.m.Y H:i:s')}}
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
