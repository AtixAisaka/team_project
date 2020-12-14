@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/landing_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hover_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/retro_button.css')}}">

    <style>
        body {
          /*  background: url("{{asset('img/landing_page.jpg')}}");
            background-size: 100% 100%; */
            /*background: rgb(144,144,144);
            background: linear-gradient(0deg, rgba(144,144,144,1) 16%, rgba(145,193,150,1) 37%, rgba(113,217,115,1) 60%, rgba(47,203,50,1) 100%);*/
        }


    </style>

    <div class="container">

        <div class="container_img">
            <img width="400" height="auto" src="{{asset('img/calendar_icon.png')}}">
        </div>

        <div class="container_join">
            <div class="button_container">
                <h1>Join ScheduleTap Today.</h1>
                <a href="{{ route('register') }}">
                    <button  class="hover_btn"><span>{{ __('Register') }}</span></button>
                </a>
                <a href="{{ route('login') }}">
                    <button  class="hover_btn2"><span>{{ __('Sign In') }}</span></button>
                </a>
                <a href="{{ url('/events') }}"><h2>Pokračovať bez registrácie.</h2></a>
            </div>
        </div>






    </div>

    <div class="container">
        <div class="container_text">
            <h1><img width="22" height="auto" src="{{asset('img/bullet_pointer.png')}}">Buď informovaný o podujatiach a najnovších akciách.</h1>
        </div>
        <div class="container_text">
            <h1><img width="22" height="auto" src="{{asset('img/bullet_pointer.png')}}">Buď informovaný o podujatiach a najnovších akciách.</h1>
        </div>
        <div class="container_text">
            <h1><img width="22" height="auto" src="{{asset('img/bullet_pointer.png')}}">Buď informovaný o podujatiach a najnovších akciách.</h1>
        </div>
    </div>

        {{--<section id="intro">
            <div id="intro-content" class="center-content">
                <div class="center-content-inner">
                    <div class="content-section content-section-margin">
                        <div class="content-section-grid clearfix">
                            <a href="#" class="button nav-link" style="text-decoration: none">
                                <div class="bottom"></div>
                                <div class="top">
                                    <div class="label">Go Retro Baby</div>
                                    <div class="button-border button-border-left"></div>
                                    <div class="button-border button-border-top"></div>
                                    <div class="button-border button-border-right"></div>
                                    <div class="button-border button-border-bottom"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>--}}



@endsection
