<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://code.jquery.com/jquery.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-dark bg-primary">
        <div class="navbar-brand valign-center">
            @guest
                Neprihlásený úžívateľ
            @else
                @if(Auth::user()->role==4)
                    Administrátor, {{Auth::user()->name}}
                @else
                    Užívateľ, {{Auth::user()->name}}
                @endif
            @endguest
        </div>
        <button class="navbar-toggler text" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{action("EventsController@index")}}">Kalendár udalostí</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{action("EventsController@showEventList")}}">Zoznam udalostí</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Prihlásiť') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrovať') }}</a>
                            </li>
                        @endif
                    @else
                        @if(Auth::user()->role==4)
                            <li class="nav-item">
                                <a class="nav-link" href="{{action("EventsController@showEventList")}}">Zoznam udalostí</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{action("UsersController@showUserList")}}">Zoznam používateľov</a>
                            </li>
                            <li class="nav-item">
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form><a class="nav-link" href="{{route("logout")}}">Odhlásiť</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{action("EventsController@index")}}">Kalendár udalostí</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{action("EventsController@showEventList")}}">Zoznam udalostí</a>
                            </li>
                            <li class="nav-item">
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form><a class="nav-link" href="{{route("logout")}}">Odhlásiť</a>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>

