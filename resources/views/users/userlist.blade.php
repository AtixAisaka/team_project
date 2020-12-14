@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/user_list.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Filtrovanie</h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{action('UsersController@filterUsers')}}">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-5">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="name"><b>Podľa mena</b></label><br>
                                            @if(Session::get("username") != "") <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" value="{{Session::get("username")}}">
                                            @else <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" placeholder="Meno/časť mena" value="">
                                            @endif
                                        </div>

                                        <div class="">
                                            <label for="name"><b>Podľa role</b></label><br>
                                            <select id="role" name="role" >
                                                @if(Session::get("userrole") == "") <option selected="selected" value="">No Filter</option>
                                                @else <option value="">No Filter</option>
                                                @endif

                                                @if(Session::get("userrole") == "0") <option selected="selected" value="0">Užívateľ</option>
                                                @elseif(Session::get("userrole") == "1") <option selected="selected" value="1">Pracovník pracoviska</option>
                                                @elseif(Session::get("userrole") == "2") <option selected="selected" value="2">Referent fakulty</option>
                                                @elseif(Session::get("userrole") == "3") <option selected="selected" value="3">Referent univerzity</option>
                                                @elseif(Session::get("userrole") == "4") <option selected="selected" value="4">Administrátor</option>
                                                @endif

                                                @if(Session::get("userrole") != "0") <option value="0">Užívateľ</option> @endif
                                                @if(Session::get("userrole") != "1") <option value="1">Pracovník pracoviska</option> @endif
                                                @if(Session::get("userrole") != "2") <option value="2">Referent fakulty</option> @endif
                                                @if(Session::get("userrole") != "3")  <option value="3">Referent univerzity</option> @endif
                                                @if(Session::get("userrole") != "4")  <option value="4">Administrátor</option> @endif
                                            </select>
                                        </div>

                                        <div class=""><br>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input class="btn effect01" type="submit" name="submit" value="Filtrovať"><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavri</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <div style="display: flex">
<!--            <button class="btn-filter" type="button"  data-toggle="modal" data-target="#filterModal">
                <i class="fa fa-filter"></i>
            </button>-->
            <div style="font-size: 43px; padding-right: 10px;">
            <a class="a_icon" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter"></i></a>
            </div>
            <div style="display: inline;border-left: 3px solid #474747;height: 50px;padding-left: 8px;">
                <h2>Zoznam používateľov</h2>
            </div>
        </div>

        <li class="table-header">
            <div class="col col-1">ID</div>
            <div class="col col-2">Name</div>
            <div class="col col-3">Email</div>
            <div class="col col-4">Role</div>
            <div class="col col-5"></div>
        </li>

       {{-- style="color: rgb(76, 175, 80)--}}

        @foreach($users as $row)

                <li class="table-row">
                    <div class="col col-1">{{$row-> id}}</div>
                    <div class="col col-2">{{$row-> name}}</div>
                    <div class="col col-3">{{$row-> email}}</div>
                    <div class="col col-4">
                        @if($row->role == 0) Používateľ
                        @elseif($row->role == 1) Pracovník pracoviska
                        @elseif($row->role == 2) Referent Fakulty
                        @elseif($row->role == 3) Referent Univerzity
                        @else Administrátor
                        @endif
                         ({{$row-> role}})
                    </div>
                    <div class="col col-5">
                        <a class="btn-1" href="{{ action("UsersController@showEditUser",["id" => $row -> id])  }}" role="button">Edit</a>
                        | <a class="btn-1" href="{{ action("UsersController@deleteUserAction",["id" => $row -> id])  }}" role="button">Delete</a>
                        | <div class="dropdown">
                            <button class="btn-1" style="background-color: white; border: white; color: rgb(76, 175, 80);size: auto">Events</button>
                            <div class="dropdown-content">
                                <a href="{{ action("EventsController@showEventsHistory",["value" => 0, "id" => $row->id, "admin" => 1])  }}">Založené</a>
                                <a href="{{ action("EventsController@showEventsHistory",["value" => 1, "id" => $row->id, "admin" => 1])  }}">Zúčastnené</a>
                            </div>
                        </div>
                    </div>
                </li>
        @endforeach

    </div>

    <script type="text/javascript">
        $(function() {
            // initialize sol
            $('#role').searchableOptionList({
                maxHeight: '250px',
                modal: true
            });
        });
    </script>
@endsection
