@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/landing_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hover_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/retro_button.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <div id="Carousel" class="carousel slide col-lg-8 col-offset-2" style="width: 100%;background-color: rgba(0,0,0,0.5);margin-top: -20px;padding: 0px;">
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
                    <img style="height: 500px;overflow:visible" src="{{asset('img/landing_page.jpg')}}" class="img-responsive">
                    <div class="event_info"><div style="font-size: 30px">Nazov</div>
                        Od: Do:
                    </div>
                </div>
                @foreach($events as $row)
                    <div class="item">
                        <img style="height: 500px;position: relative" src="{{asset('img/landing_page3.jpg')}}">
                        <div class="event_info">
                            <div style="font-size: 30px">{{$row->event_name}}&nbsp;</div>
                            Od: {{\Carbon\Carbon::parse($row->start_date)->format('d.m.Y H:i:s')}}
                            &nbsp; Do: {{\Carbon\Carbon::parse($row->end_date)->format('d.m.Y H:i:s')}}
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


    <div class="container" style="margin-bottom: 200px">
        @guest
        <div class="container_join">
            <div class="button_container">
                <h1>Join ScheduleTap Today.</h1>
                <a class="a_custom" href="{{ route('register') }}">
                    <button  class="hover_btn"><span>{{ __('Register') }}</span></button>
                </a>
                <a class="a_custom" href="{{ route('login') }}">
                    <button  class="hover_btn2"><span>{{ __('Sign In') }}</span></button>
                </a>
                <a class="a_custom" href="{{ url('/events') }}"><h2>Pokračovať bez registrácie.</h2></a>
            </div>
        </div>
        @else
        <div class="container_join">
            <div class="button_container">
                <h1>You are signed in</h1>
                <a class="a_custom" href="{{ url('/events') }}">
                    <button  class="hover_btn"><span>{{ __('Open Callendar') }}</span></button>
                </a>

            </div>
        </div>
        @endguest
    </div>
@endsection
