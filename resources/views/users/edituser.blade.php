@extends("layouts.app")
@section('content')
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>
    <div class="container">
        <div class="row justify-content-md-center">
        <div class="breadcrumb">

                <form method="post" action="{{action('UsersController@updateUserAction')}}">
                    Meno:<br>
                    <input type="text" name="name" value="{{ $user->name }}"><br>
                    Email:<br>
                    <input type="text" name="email" value="{{ $user->email }}"><br>
                    Role:<br>
                    <select id="role" name="role" class="form-control">
                        <option value="0">Užívateľ</option>
                        <option value="1">Poverený pracovník pracoviska</option>
                        @if(Auth::User()->role >= 3)
                        <option value="2">Referent fakulty</option>
                        @endif
                        @if(Auth::User()->role >= 4)
                        <option value="3">Referent univerzity</option>
                        <option value="4">Administrátor</option>
                        @endif
                    </select> <br>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="submit" name="submit" value="Uložiť"><br>
                </form>
        </div>
    </div>
    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
