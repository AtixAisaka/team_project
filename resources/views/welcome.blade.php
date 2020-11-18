@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/landing_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hover_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/retro_button.css')}}">

    <style>
        body {
            animation: theme 21s linear infinite;
        }body:after,
                 body:before {
             content: '';
             display: block;
             position: fixed;
             z-index: -1;
             top: 0;
             width: 100vw;  // IE/Edge
         height: 100vh; // fallback
         width: 100vmax;
             height: 100vmax;
             background: rgba(0,0,0,0.05);
             animation: background 90s linear infinite;
         }

        body:after {
             left: 15vw;
         }

        body:before {
             right: 15vw;
             animation-delay: -30s;
             animation-direction: reverse;
         }


        @keyframes theme {
            0% {
                background: #74c377;
            }

            16% {
                background: #74c377;
            }

            33% {
                background: #5c6c84;
            }

            50% {
                background: #5c6c84;
            }

            66% {
                background: #5c6c84;
            }

            83% {
                background: #74c377;
            }

            100% {
                background: #74c377;
            }
        }

        @keyframes background {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="container">

        <div class="container_img">
            <img width="400" height="auto" src="{{asset('img/calendar_icon.png')}}">
        </div>
        @guest
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
@else
        <div class="container_join">
            <div class="button_container">
                <h1>You are signed in</h1>
                <a href="{{ url('/events') }}">
                    <button  class="hover_btn"><span>{{ __('Open Callendar') }}</span></button>
                </a>

            </div>
        </div>
        @endguest
    </div>
    <div class="container">
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
