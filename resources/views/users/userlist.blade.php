@extends("layouts.app")
@section('content')
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>

    <div class="container">
        <div class="jumbotron">
            <table>
                @foreach($users as $row)
                    <tr>
                        <td> ID: {{$row-> id}}, &nbsp; Meno: {{$row-> name}}, &nbsp; </td>
                        <td> Email: {{$row-> email}}, &nbsp;
                            Rola:
                                @if($row->role == 0) Používateľ
                                @elseif($row->role == 1) Poverený pracovník pracoviska
                                @elseif($row->role == 2) Referent Fakulty
                                @elseif($row->role == 3) Referent Univerzity
                                @else Administrátor
                                @endif
                                 ({{$row-> role}}).</td>
                        <td>
                            <a class="btn btn-primary btn" href="{{ action("UsersController@showEditUser",
                                    ["id" => $row -> id])  }}" role="button">Editovať údaje</a>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pozrieť eventy
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ action("EventsController@showEventsHistory",
                                ["value" => 0, "id" => $row->id, "admin" => 1])  }}">Minulé</a>
                                    <a class="dropdown-item" href="{{ action("EventsController@showEventsHistory",
                                ["value" => 1, "id" => $row->id, "admin" => 1])  }}">Súčasné</a>
                                    <a class="dropdown-item" href="{{ action("EventsController@showEventsHistory",
                                ["value" => 2, "id" => $row->id, "admin" => 1])  }}">Budúce</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-primary btn" href="{{ action("UsersController@deleteUserAction",
                                    ["id" => $row -> id])  }}" role="button">Mazať</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>



        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
