@extends("layouts.app")
@section('content')

    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin_event_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/event_list.css')}}">

    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <div class="container">
    @auth
        @if(Auth::User()->role!=4)
                <!-- Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Pridať event</h3>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{action('EventsController@addEvent')}}">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            @if (Session::has('success'))
                                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                                            @elseif (Session::has('warnning'))
                                                <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-5">
                                            <div class="form-group">
                                                <label for="name"><b>Meno eventu</b></label><br>
                                                <div class="">
                                                    <input type="text" name="event_name" style="margin: 5px 0 22px 0; width: 100%; " class="form-control" placeholder="Nazov eventu" value="" required autocomplete="">
                                                    {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                                <label for="name"><b>Miesto konania eventu</b></label><br>
                                                <div class="">
                                                    <input type="text" name="event_place" style="margin: 5px 0 22px 0; width: 100%; " class="form-control" placeholder="Miesto konania eventu" value="" required autocomplete="">
                                                    {!! $errors->first('event_place', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                                <label for="max_percipient"><b>Maximálny počet zúčastnených</b></label><br>
                                                <div class="">
                                                    <input type="number" id="quantity" name="max_percipient" min="1" max="25" required class="form-control">
                                                </div>
                                                @if(Auth::User()->role == 3)
                                                    <input type="hidden" name="type" value="3">
                                                    <input type="hidden" name="idkatedry" value="0">
                                                    <input type="hidden" name="idfakulty" value="0">
                                                @elseif(Auth::User()->role == 2)
                                                    <select id="idfakulty" name="idfakulty" >
                                                        @foreach($fakulty as $row)
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="type" value="2">
                                                    <input type="hidden" name="idkatedry" value="0">
                                                @elseif(Auth::User()->role == 1)
                                                    <select id="idkatedry" name="idkatedry">
                                                        @foreach($katedry as $row)
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="type" value="1">
                                                    <input type="hidden" name="idfakulty" value="0">
                                                @else
                                                    <input type="hidden" name="type" value="0">
                                                    <input type="hidden" name="idkatedry" value="0">
                                                    <input type="hidden" name="idfakulty" value="0">
                                                @endif

                                                <div class=""><br>
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="userid" value="{{$authuser -> id}}">
                                                    <input type="hidden" name="helper" value="1">
                                                    <input class="btn effect01" type="submit" name="submit" value="Pridať event"><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-7">
                                            <div class="form-group" style="margin-left: 100px">
                                                <label for="name"><b>Začiatok Eventu</b></label><br>
                                                <div class="" style="margin: 5px 0 22px 0; width: 100%; ">
                                                    <input type="datetime-local" class="form-control" name="start_date">
                                                    {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                                <label for="name"><b>Koniec Eventu</b></label><br>
                                                <div class="" style="margin: 5px 0 22px 0; width: 100%; ">
                                                    <input type="datetime-local" class="form-control" name="end_date">
                                                    {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                                <label for="name"><b>Tag</b></label><br>
                                                <div class="">
                                                    <select id="tags0"  name="tags0[]" multiple="multiple">
                                                        @foreach($tags as $row)
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
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
            </div>
        @endif
    @endauth

        <!-- Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Filtrovanie</h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{action('EventsController@filterEvents')}}">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-5">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="name"><b>Podľa názvu</b></label><br>
                                            @if(Session::get("name") != "") <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" value="{{Session::get("name")}}">
                                            @else <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" placeholder="Názov/časť názvu" value="">
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="name"><b>Od dátumu</b></label><br>
                                            @if(Session::get("start_date") != "")  <input type="datetime-local" class="form-control" name="start_date" style="margin: 5px 0 22px 0; width: 100%;" value="{{Session::get("start_date")}}">
                                            @else <input type="datetime-local" class="form-control" name="start_date" style="margin: 5px 0 22px 0; width: 100%;" value="">
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="name"><b>Do dátumu</b></label><br>
                                            @if(Session::get("end_date") != "")  <input type="datetime-local" class="form-control" name="end_date" style="margin: 5px 0 22px 0; width: 100%;" value="{{Session::get("end_date")}}">
                                            @else  <input type="datetime-local" class="form-control" name="end_date" style="margin: 5px 0 22px 0; width: 100%;" value="">
                                            @endif
                                        </div>
                                        <div class=""><br>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input class="btn effect01" type="submit" name="submit" value="Filtrovať"><br>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-1 col-md-7">
                                    <div class="form-group" style="margin-left: 100px">
                                        <div class="" style="margin-bottom: 10px">
                                            <label for="name"><b>Podľa pracoviska/fakulty</b></label><br>
                                            <select id="pracovisko" name="pracovisko">
                                                @if(Session::get("pracovisko") == "") <option selected="selected" value="">No Filter</option>
                                                @else
                                                    <option value="">No Filter</option>
                                                @endif
                                                <optgroup label="Fakulty">
                                                    @foreach($fakulty as $row)
                                                        @if($row->id == Session::get("pracovisko")) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                                        @else <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Katedry">
                                                    @foreach($katedry as $row)
                                                        @if($row->id == Session::get("pracovisko")) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                                        @else <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="" style="margin-bottom: 10px">
                                            <label for="name"><b>Podľa typu</b></label><br>
                                            <select id="type" name="type" >
                                                @if(Session::get("type") == "") <option selected="selected" value="">No Filter</option>
                                                @else <option value="">No Filter</option>
                                                @endif

                                                @if(Session::get("type") == "0") <option selected="selected" value="0">Študentské eventy</option>
                                                @elseif(Session::get("type") == "1") <option selected="selected" value="1">Eventy pracovísk</option>
                                                @elseif(Session::get("type") == "2") <option selected="selected" value="2">Eventy fakúlt</option>
                                                @elseif(Session::get("type") == "3") <option selected="selected" value="3">Eventy univerzity</option>
                                                @endif

                                                @if(Session::get("type") != "0") <option value="0">Študentské eventy</option> @endif
                                                @if(Session::get("type") != "1") <option value="1">Eventy pracovísk</option> @endif
                                                @if(Session::get("type") != "2") <option value="2">Eventy fakúlt</option> @endif
                                                @if(Session::get("type") != "3")  <option value="3">Eventy univerzity</option> @endif
                                            </select>
                                        </div>
                                        <div class="" style="margin-bottom: 10px">
                                            <label for="name"><b>Podľa typu 2</b></label><br>
                                            <select id="type2" name="type2" >
                                                @if(Session::get("type2") == "") <option selected="selected" value="">No Filter</option>
                                                @else <option value="">No Filter</option>
                                                @endif

                                                @if(Session::get("type2") == "0") <option selected="selected" value="0">Skončené eventy</option>
                                                @elseif(Session::get("type2") == "1") <option selected="selected" value="1">Prebiehajúce eventy</option>
                                                @elseif(Session::get("type2") == "2") <option selected="selected" value="2">Budúce eventy</option>
                                                @endif

                                                @if(Session::get("type2") != "0") <option value="0">Skončené eventy</option> @endif
                                                @if(Session::get("type2") != "1") <option value="1">Prebiehajúce eventy</option> @endif
                                                @if(Session::get("type2") != "2") <option value="2">Budúce eventy</option> @endif
                                            </select>
                                        </div>
                                        <div class="">
                                            <label for="name"><b>Podla tagov</b></label><br>
                                            <select id="tags"  name="tag[]" multiple="multiple">
                                                @if(Session::get("tag") != "")
                                                    @foreach($tags as $row)
                                                        @if(in_array($row->id, Session::get("tag"))) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                                        @else <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach($tags as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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

    <div class="col-xs-12 col-sm-12 col-md-12">
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('warnning'))
            <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
        @endif

    </div>
            <div class="container">
                <div class="dropdown">
                    <h2>Eventy  <span class="caret"></span></h2>
                    <div class="dropdown-content" style="cursor: pointer;" >
                        @auth
                        <a type="button" data-toggle="modal" data-target="#addModal">
                            <div class="valign-center" style="cursor: pointer;">Pridať event
                            </div>
                        </a>
                        @endauth
                        <a type="button" data-toggle="modal" data-target="#filterModal">
                            <div class="valign-center" style="cursor: pointer;">Filtrovať eventy
                            </div>
                        </a>
                    </div>
                </div>

                <div>
                @foreach($events as $event)
                    @if($event->ishidden==false || Auth::user()->role==4)
                        <div class="gallery">
<!--                            <div class="NAZOV">{{--{{$event-> event_name}}--}}</div>-->
                            <div class="event_preview"><img src="{{asset('img/calendar_icon.png')}}"></div>
                            <div class="event_description">
                                <div style="font-size: 20px; font-weight: bold; " >{{$event-> event_name}}</div>
                                <strong>Začiatok eventu: </strong>{{\Carbon\Carbon::parse($event->start_date)->format('d.m.Y H:i:s')}}<br>
                                <strong>Koniec eventu: </strong>{{\Carbon\Carbon::parse($event->end_date)->format('d.m.Y H:i:s')}}
                            </div>

                            <div class="event_buttons">
                                <a class="btn-1" href="{{ action("EventsController@showEventInfo",  ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button" target="_blank">
                                    <div class="valign-center"> <i class="material-icons">
                                            help_outline </i> Detaily
                                    </div></a>
                                @auth
                                    @if($event->userid == $authuser->id || Auth::user()->role==4)
                                        <a class="btn-1" href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1, "userid" => -1, "admin" => -1]) }}" role="button">
                                            <div class="valign-center"> <i class="material-icons">
                                                    build </i> Editovať
                                            </div></a>
                                        <a class="btn-1" href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}" role="button">
                                            <div class="valign-center"> <i class="material-icons">
                                                    delete </i> Mazať
                                            </div></a>
                                        @if(Auth::user()->role==4)
                                            @if($event->ishidden == false)
                                                <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}" role="button">
                                                    <div class="valign-center"> <i class="material-icons">
                                                            toggle_off </i> Skryť
                                                    </div></a>
                                            @elseif($event->ishidden == true)
                                                <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}" role="button">
                                                    <div class="valign-center"> <i class="material-icons">
                                                            toggle_on </i> Odkryť
                                                    </div></a>
                                            @endif
                                        @endif
                                    @endif

                                    @if($event->userid != $authuser->id)
                                        @php
                                            $helper = 0
                                        @endphp
                                        @foreach($helpertable as $row)
                                            @if ($row->userid == $authuser->id && $row->eventid == $event->id)
                                                @php
                                                    $helper = 1
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if(Auth::User()->role==0)
                                            @if($helper == 0)
                                                <a class="btn-1" href="{{ action("EventsController@addUserToEvent", ["id" => $event->id]) }}" role="button">
                                                    <div class="valign-center"> <i class="material-icons">
                                                            person_add </i> Zúčastniť sa
                                                    </div></a>
                                            @else
                                                <a class="btn-1" href="{{ action("EventsController@removeUserFromEvent", ["id" => $event->id]) }}" role="button">
                                                    <div class="valign-center"> <i class="material-icons">
                                                            cancel </i> Zrušiť účasť
                                                    </div></a>
                                            @endif
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>






            </div>

            <br><br><br>


            <script type="text/javascript">
                    $(function() {
                        // initialize sol
                        $('#idfakulty').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                        $('#idkatedry').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                        $('#tags0').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                        $('#tags').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                        $('#pracovisko').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                        $('#type').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                        $('#type2').searchableOptionList({
                            maxHeight: '250px',
                            modal: true
                        });
                    });
            </script>
@endsection
