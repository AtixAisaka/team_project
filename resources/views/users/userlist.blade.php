@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/user_list.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <div class="container">
        <h2>Zoznam používateľov</h2>

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
                        <a class="btn-1" href="{{ action("UsersController@showEditUser",["id" => $row -> id])  }}" role="button" target="_blank">Edit</a>
                        | <a class="btn-1" href="{{ action("UsersController@deleteUserAction",["id" => $row -> id])  }}" role="button" target="_blank">Delete</a>
                        | <div class="dropdown">
                            <button class="btn-1" style="background-color: white; border: white; color: rgb(30, 144, 255);size: auto">Events</button>
                            <div class="dropdown-content">
                                <a href="{{ action("EventsController@showEventsHistory",["value" => 0, "id" => $row->id, "admin" => 1])  }}">Založené</a>
                                <a href="{{ action("EventsController@showEventsHistory",["value" => 1, "id" => $row->id, "admin" => 1])  }}">Zúčastnené</a>
                            </div>
                        </div>
                    </div>
                </li>
        @endforeach

    </div>
@endsection
