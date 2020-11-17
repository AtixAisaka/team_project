@extends("layouts.app")
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">

    <div class="container">
        <form method="post" action="{{action('UsersController@updateUserAction')}}">
            <h2>Edit user</h2><br>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <div class="">
                            <label for="name"><b>Name</b></label><br>
                            <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="">
                            <label for="email"><b>Email</b></label><br>
                            <input class="form-control" type="text" name="email" value="{{ $user->email }}"><br>
                        </div>
                        <div class="">
                            <label for="role"><b>Role</b></label><br>
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
                            </select>
                        </div>
                        <div class=""><br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input class="btn effect01" type="submit" name="submit" value="Uložiť"><br>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
