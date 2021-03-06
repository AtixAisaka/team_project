@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/landing_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hover_button.css')}}">

        <div id="Carousel" class="carousel slide col-lg-8 col-offset-2" style="width: 100%;background-color: rgba(0,0,0,0.5);margin-top: -20px;padding: 0px;">
            @if($firstevent!="null")
            <ol class="carousel-indicators" style="padding-bottom: 40px">
                <li data-target="Carousel" data-slide-to="0" class="active"></li>
                <li data-target="Carousel" data-slide-to="1"></li>
                <li data-target="Carousel" data-slide-to="2"></li>
<!--                if more slides-->
<!--                <li data-target="Carousel" data-slide-to="3"></li>
                <li data-target="Carousel" data-slide-to="4"></li>-->
            </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <!--<img style="height: 500px;overflow:visible" src="asset('img/landing_page.jpg')" class="img-responsive">-->
                            <a href="{{ action("EventsController@showEventInfo",  ["id" => $firstevent->id, "param" => "-2", "userid" => "-1", "admin" => "-1"]) }}">
                                @if($firstevent->display_image != "none")
                                    <img style="height: 500px;overflow:visible" src="{{ url('/') }}/storage/images/users/{{ $firstevent-> display_image }}" class="img-responsive">
                                @else
                                    <img style="height: 500px;overflow:visible" src="{{asset('img/meeting.jpg')}}">
                                @endif</a>
                        <div class="event_info">
                            <div class="event_title">{{$firstevent->event_name}}</div>
                            Od: {{\Carbon\Carbon::parse($firstevent->start_date)->format('d.m.Y H:i:s')}}
                            &nbsp; Do: {{\Carbon\Carbon::parse($firstevent->end_date)->format('d.m.Y H:i:s')}}
                            @auth
                                @if($firstevent->userid != $authuser->id)
                                    @php
                                        $helper = 0
                                    @endphp
                                    @foreach($helpertable as $row)
                                        @if ($row->userid == $authuser->id && $row->eventid == $firstevent->id)
                                            @php
                                                $helper = 1
                                            @endphp
                                            @break
                                        @endif
                                    @endforeach
                                    @if(\Carbon\Carbon::parse($firstevent->start_date)->isFuture() && Auth::User()->role==0)
                                        @if($helper == 0)
                                            <a class="a_icon" href="{{ action("EventsController@addUserToEvent", ["id" => $firstevent->id, "param" => 1]) }}" role="button">
                                                <i class="material-icons">person_add</i>
                                            </a>
                                        @else
                                            <a class="a_icon" href="{{ action("EventsController@removeUserFromEvent", ["id" => $firstevent->id, "param" => 1]) }}" role="button">
                                                <i class="material-icons">cancel</i>
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                        @foreach($events as $row)
                            <div class="item" style="height: 500px">
                                <!--<img style="height: 500px;position: relative" src="asset('img/landing_page3.jpg')">-->
                                    <a href="{{ action("EventsController@showEventInfo",  ["id" => $row->id, "param" => "-2", "userid" => "-1", "admin" => "-1"]) }}">
                                        @if($row->display_image != "none")
                                            <img style="max-height: 500px;" src="{{ url('/') }}/storage/images/users/{{ $row-> display_image }}" class="img-responsive">
                                        @else
                                            <img style="max-height: 500px;" src="{{asset('img/meeting.jpg')}}">
                                        @endif</a>
                                <div class="event_info">
                                    <div class="event_title">{{$row->event_name}}&nbsp;</div>
                                    Od: {{\Carbon\Carbon::parse($row->start_date)->format('d.m.Y H:i:s')}}
                                    &nbsp; Do: {{\Carbon\Carbon::parse($row->end_date)->format('d.m.Y H:i:s')}}
                                    @auth
                                        @if($row->userid != $authuser->id)
                                            @php
                                                $helper = 0
                                            @endphp
                                            @foreach($helpertable as $roww)
                                                @if ($roww->userid == $authuser->id && $roww->eventid == $row->id)
                                                    @php
                                                        $helper = 1
                                                    @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if(\Carbon\Carbon::parse($row->start_date)->isFuture() && Auth::User()->role==0)
                                                @if($helper == 0)
                                                    <a class="a_icon" href="{{ action("EventsController@addUserToEvent", ["id" => $row->id, "param" => 1]) }}" role="button">
                                                         <i class="material-icons">person_add</i>
                                                    </a>
                                                @else
                                                    <a class="a_icon" href="{{ action("EventsController@removeUserFromEvent", ["id" => $row->id, "param" => 1]) }}" role="button">
                                                        <i class="material-icons">cancel</i>
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
            </div>
            <a class="left carousel-control" href="#Carousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#Carousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
        @else
                    <a href="{{ action("EventsController@showEventList")}}">
                        <img style="height: 500px;overflow:visible; margin-left: auto;  margin-right: auto; display: block;" src="{{asset('img/calendar.png')}}"></a>
                    <div class="event_info">
                        <div class="event_title">Pridajte event práve teraz!</div>
        @endif


    <div class="container">
        @guest
        <div class="container_join" style="margin-bottom: 230px">
            <div class="button_container">
                <h1>Pripojte sa do ScheduleTap dnes.</h1>
                <a class="a_custom" href="{{ route('register') }}">
                    <button  class="hover_btn"><span>{{ __('Registrácia') }}</span></button>
                </a>
                <a class="a_custom" href="{{ route('login') }}">
                    <button  class="hover_btn2"><span>{{ __('Prihláste sa') }}</span></button>
                </a>
                <a class="a_custom" href="{{ url('/events') }}"><h2>Pokračovať bez registrácie.</h2></a>
            </div>
        </div>
        @else
        <div class="container_join" style="margin-bottom: 260px">
            <div class="button_container">
                <h1>Ste prihlásený</h1>
                <a class="a_custom" href="{{ url('/events') }}">
                    <button  class="hover_btn"><span>{{ __('Otvoriť kalendár') }}</span></button>
                </a>

            </div>
        </div>
        @endguest
    </div>
@endsection
