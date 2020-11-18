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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" id="bootstrap-css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function(){
            //Handles menu drop down
            $('.dropdown-menu').find('form').click(function (e) {
                e.stopPropagation();
            });
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

</head>
<body>
<div class="container1">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}"><img width="115px" height="18px" src="{{asset('img/scheduletap_icon.png')}}"></a>

                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class={{(request()->is('/'))? 'active': ''}}><a href="{{ url('/') }}">Home</a></li>
                        @guest
                            <li class={{ (request()-> is('events'))? 'active': '' }}><a href="{{action("EventsController@index")}}">Kalendár udalostí</a></li>
                            <li class={{ (request()-> is('eventlist'))? 'active': '' }}><a href="{{action("EventsController@showEventList")}}">Zoznam udalostí</a></li>
                        @else
                            @if(Auth::user()->role==4)
                                <li class="dropdown">
                                <li class={{ (request()-> is('eventlist'))? 'active': '' }}><a href="{{action("EventsController@showEventList")}}">Zoznam udalostí</a></li>
                                <li class={{ (request()-> is('userlist'))? 'active': '' }}><a href="{{action("UsersController@showUserList")}}">Zoznam používateľov</a></li>
                                </li>
                            @else
                                <li class={{ (request()-> is('events'))? 'active': '' }}><a href="{{action("EventsController@index")}}">Kalendár udalostí</a></li>
                                <li class={{ (request()-> is('eventlist'))? 'active': '' }}><a href="{{action("EventsController@showEventList")}}">Zoznam udalostí</a></li>
                                <li class={{ (request()-> is('eventhistory'))? 'active': '' }}>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Moje Udalosti
                                            <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 0, "id" => Auth::user()->id, "admin" => -1])  }}">Založené</a><br>
                                            <a href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 1, "id" => Auth::user()->id, "admin" => -1])  }}">Zúčastnené</a><br>
                                        </div>
                                    </li>
                                </li>
                            @endif
                        @endguest
                        <li class={{ (request()-> is('aboutus'))? 'active': '' }}><a href="{{ url('/aboutus') }}">About Us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @guest
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                                <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form" role="form" method="post" action="{{ route('login') }}" accept-charset="UTF-8" id="login-nav">
                                                    @csrf

                                                    <div class="form-group">
                                                        <input id="email" type="email" placeholder="Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                         </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <input id="password" type="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                         </span>
                                                        @enderror
                                                    </div>

                                                    <div class="checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="remember">Remember me</label>
                                                    </div>



                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </ul>
                            </li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} -
                                    @if(Auth::user()->role == 4)Administrátor
                                    @elseif(Auth::user()->role == 3)Referent Univerzity
                                    @elseif(Auth::user()->role == 2)Referent Fakulty
                                    @elseif(Auth::user()->role == 1)Pracovník pracoviska
                                    @else Užívateľ
                                    @endif
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{action("UserController@profile")}}">Profile</a><br>
                                    <a href="{{action("EventsController@tagsView")}}">Zoznam tagov</a><br>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                        @endguest
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>
<div class="wrapper">
    <main class="py-4">
        @yield('content')
    </main>
    @include('layouts.footer')
</div>
</body>
</html>
