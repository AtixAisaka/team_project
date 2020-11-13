@extends("layouts.app")
@section('content')

    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    @auth
        @if(Auth::User()->role!=4)
            <div class="container">
                <div class="breadcrumb border border-primary">
                        <form method="post" action="{{action('EventsController@addEvent')}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                                    @elseif (Session::has('warnning'))
                                        <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                                    @endif

                                </div>


                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        Meno Eventu
                                        <div class="">
                                            <input type="text" name="event_name" placeholder="Nazov eventu" value="">
                                            {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        Miesto konania Eventu
                                        <div class="">
                                            <input type="text" name="event_place" placeholder="Miesto konania Eventu" value="">
                                            {!! $errors->first('event_place', '<p class="alert alert-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::User()->role == 3)
                                    <input type="hidden" name="type" value="3">
                                    <input type="hidden" name="idkatedry" value="0">
                                    <input type="hidden" name="idfakulty" value="0">
                                @elseif(Auth::User()->role == 2)
                                    <select id="idfakulty" name="idfakulty" class="form-control">
                                        @foreach($fakulty as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="type" value="2">
                                    <input type="hidden" name="idkatedry" value="0">
                                @elseif(Auth::User()->role == 1)
                                    <!-- Sem doplnit ten select so searchom !-->
                                    <select id="idkatedry" name="idkatedry" class="form-control">
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

                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        Začiatok Eventu
                                        <div class="">
                                            <input type="date" name="start_date" value="">
                                            {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        Koniec Eventu
                                        <div class="">
                                            <input type="date" name="end_date" value="">
                                            {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        tagy
                                        <select id="tags0"  name="tag[]" multiple="multiple">
                                            @if($tag != "")
                                                @foreach($tags as $row)
                                                    @if(in_array($row->id, $tag)) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
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

                                <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="userid" value="{{$authuser -> id}}">
                                    <input type="hidden" name="helper" value="1">
                                    <input type="submit" name="submit" value="Pridať event"><br>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        @endif
    @endauth

    <div class="container border border-dark">
        <h3>Filtrovanie</h3>
        <form method="post" action="{{action('EventsController@filterEvents')}}">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        Podľa názvu
                        @if($name != "") <input type="text" name="name" value="{{$name}}">
                        @else <input type="text" name="name" placeholder="Názov/časť názvu" value="">
                        @endif
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        Podľa typu
                        <select id="type" name="type" >
                            @if($type == "") <option selected="selected" value="">No Filter</option>
                            @else <option value="">No Filter</option>
                            @endif

                            @if($type == "0") <option selected="selected" value="0">Študentské eventy</option>
                            @elseif($type == "1") <option selected="selected" value="1">Eventy pracovísk</option>
                            @elseif($type == "2") <option selected="selected" value="2">Eventy fakúlt</option>
                            @elseif($type == "3") <option selected="selected" value="3">Eventy univerzity</option>
                            @endif

                            @if($type != "0") <option value="0">Študentské eventy</option> @endif
                            @if($type != "1") <option value="1">Eventy pracovísk</option> @endif
                            @if($type != "2") <option value="2">Eventy fakúlt</option> @endif
                            @if($type != "3")  <option value="3">Eventy univerzity</option> @endif
                        </select>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        Podľa pracoviska/fakulty
                        <select id="pracovisko" name="pracovisko" >
                            @if($pracovisko == "") <option selected="selected" value="">No Filter</option>
                            @else
                                <option value="">No Filter</option>
                            @endif
                                <optgroup label="Fakulty">
                                    @foreach($fakulty as $row)
                                        @if($row->id == $pracovisko) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                        @else <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="Katedry">
                                    @foreach($katedry as $row)
                                        @if($row->id == $pracovisko) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                        @else <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        Od dátumu
                        @if($start_date != "") <input type="date" name="start_date" value="{{$start_date}}">
                        @else <input type="date" name="start_date" value="">
                        @endif
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        Do dátumu
                        @if($end_date != "") <input type="date" name="end_date" value="{{$end_date}}">
                        @else <input type="date" name="end_date" value="">
                        @endif
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        Podla tagov
                        <select id="tags"  name="tag[]" multiple="multiple">
                            @if($tag != "")
                                @foreach($tags as $row)
                                    @if(in_array($row->id, $tag)) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
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
                <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" name="submit" value="Filtrovať podla informácii"><br>
                </div>
            </div>

        @auth
            @if(Auth::User()->role==0)
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <a class="btn btn-primary btn" href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 0, "id" => Auth::user()->id, "admin" => -1])  }}" role="button">Moje minulé eventy</a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="text-center">
                            <a class="btn btn-primary btn" href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 1, "id" => Auth::user()->id, "admin" => -1])  }}" role="button">Moje súčasné eventy</a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="text-center">
                            <a class="btn btn-primary btn" href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 2, "id" => Auth::user()->id, "admin" => -1])  }}" role="button">Moje budúce eventy</a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
        <div class="row justify-content-center">
            <div class="breadcrumb border border-primary">
                <div class="col">
                    <h4>Skončené eventy</h4>
                    <table>
                        @foreach($passedevents as $event)
                            @if($event->ishidden==false || Auth::user()->role==4)
                                <tr>
                                    <td> {{$event-> event_name}} </td>
                                    @auth
                                        @if(Auth::user()->role==4)
                                            <td>
                                                <a href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1,
                                            "userid" => -1, "admin" => -1]) }}">&nbsp; Editovať&nbsp;</a>
                                            </td>
                                            <td>
                                                <a href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}">Mazať&nbsp;</a>
                                            </td>
                                            <td>
                                                @if($event->ishidden == false)
                                                    <a href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}">Skryť&nbsp;</a>
                                                @elseif($event->ishidden == true)
                                                    <a href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}">Odkryť&nbsp;</a>
                                                @endif
                                            </td>
                                        @endif
                                    @endauth
                                    <td>
                                        <a class="btn btn-primary btn" href="{{ action("EventsController@showEventInfo",
                                                ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button"
                                           target="_blank">Detaily</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="breadcrumb border border-primary">
                <div class="col">
                    <h4>Prebiehajúce eventy</h4>
                    <table>
                        @foreach($activeevents as $event)
                            @if($event->ishidden==false || Auth::user()->role==4)
                                <tr>
                                    <td> {{$event-> event_name}} </td>
                                    @auth
                                        @if(Auth::user()->role==4)
                                            <td>
                                                <a href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1,
                                            "userid" => -1, "admin" => -1]) }}">&nbsp; Editovať&nbsp;</a>
                                            </td>
                                            <td>
                                                <a href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}">Mazať&nbsp;</a>
                                            </td>
                                            <td>
                                                @if($event->ishidden == false)
                                                    <a href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}">Skryť&nbsp;</a>
                                                @elseif($event->ishidden == true)
                                                    <a href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}">Odkryť&nbsp;</a>
                                                @endif
                                            </td>
                                        @endif
                                    @endauth
                                    <td>
                                        <a class="btn btn-primary btn" href="{{ action("EventsController@showEventInfo",
                                                ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button"
                                           target="_blank">Detaily</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="breadcrumb border border-primary">
                <div class="col">
                    <h4>Nadchádzajúce eventy</h4>
                    <table>
                        @foreach($futureevents as $event)
                            @if($event->ishidden==false || Auth::user()->role==4)
                                <tr>
                                    <td> {{$event-> event_name}}</td>
                                    @auth
                                        @if($event->userid == $authuser->id || Auth::user()->role==4)
                                            <td>
                                                <a href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1,
                                            "userid" => -1, "admin" => -1]) }}">&nbsp; Editovať&nbsp;</a>
                                            </td>
                                            <td>
                                                <a href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}">Mazať&nbsp;</a>
                                            </td>
                                            <td>
                                                @if(Auth::user()->role==4)
                                                    @if($event->ishidden == false)
                                                        <a href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}">Skryť&nbsp;</a>
                                                    @elseif($event->ishidden == true)
                                                        <a href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}">Odkryť&nbsp;</a>
                                                    @endif
                                                @endif
                                            </td>
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
                                                    <td>
                                                        <a href="{{ action("EventsController@addUserToEvent", ["id" => $event->id]) }}">&nbsp; Zúčastniť sa</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ action("EventsController@removeUserFromEvent", ["id" => $event->id]) }}">&nbsp; Zrušiť účasť</a>
                                                    </td>
                                                @endif
                                            @endif
                                        @endif
                                    @endauth
                                    <td>
                                        <a class="btn btn-primary btn" href="{{ action("EventsController@showEventInfo",
                                                ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button"
                                           target="_blank">Detaily</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


            <script type="text/javascript">
                $(function() {
                    // initialize sol
                    $('#tags0').searchableOptionList();
                    $('#tags').searchableOptionList();
                    $('#pracovisko').searchableOptionList();
                    $('#type').searchableOptionList();
                });
            </script>
@endsection
