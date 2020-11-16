@extends("layouts.app")
@section('content')

    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin_event_button.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    @auth
        @if(Auth::User()->role!=4)
            <div class="container">
                <h2>Pridaj event</h2><br>
                <form method="post" action="{{action('EventsController@addEvent')}}">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @elseif (Session::has('warnning'))
                                <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                            @endif

                        </div>




                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="name"><b>Meno Eventu</b></label><br>
                                <div class="">
                                    <input type="text" name="event_name" style="margin: 5px 0 22px 0; width: 100%; " class="form-control" placeholder="Nazov eventu" value="" required autocomplete="">
                                    {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                                <label for="name"><b>Miesto konania eventu</b></label><br>
                                <div class="">
                                    <input type="text" name="event_place" style="margin: 5px 0 22px 0; width: 100%; " class="form-control" placeholder="Miesto konania eventu" value="" required autocomplete="">
                                    {!! $errors->first('event_place', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                                <div class=""><br>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="userid" value="{{$authuser -> id}}">
                                    <input type="hidden" name="helper" value="1">
                                    <input class="btn effect01" type="submit" name="submit" value="Pridať event"><br>
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




                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group" style="margin-left: 100px">
                                <label for="name"><b>Začiatok Eventu</b></label><br>
                                <div class="" style="margin: 5px 0 22px 0; width: 100%; ">
                                    {!! Form::date('start_date', null, ['class' => 'form-control'], ['required autocomplete' => '']) !!}
                                    {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                                <label for="name"><b>Koniec Eventu</b></label><br>
                                <div class="" style="margin: 5px 0 22px 0; width: 100%; ">
                                    {!! Form::date('end_date', null, ['class' => 'form-control'], ['required autocomplete' => '']) !!}
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
                <br><hr>
            </div>
        @endif
    @endauth



    <div class="container border border-dark">
        <h2>Filtrovanie</h2><br>
        <form method="post" action="{{action('EventsController@filterEvents')}}">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <div class="">
                            <label for="name"><b>Podľa názvu</b></label><br>
                            @if(Session::get("name") != "") <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" value="{{Session::get("name")}}">
                            @else <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="name" placeholder="Názov/časť názvu" value="">
                            @endif
                        </div>
                        <div class="">
                            <label for="name"><b>Od dátomu</b></label><br>
                            @if(Session::get("start_date") != "") {!! Form::date('start_date', null, ['class' => 'form-control', 'style="margin: 5px 0 22px 0; width: 100%; ', 'type=date', 'name=start_date', 'value=Session::get("start_date")'  ]) !!}
                            @else {!! Form::date('start_date', null, ['class' => 'form-control', 'style="margin: 5px 0 22px 0; width: 100%; ', 'type=date', 'name=start_date', 'value=""'  ]) !!}
                            @endif
                        </div>
                        <div class="">
                            <label for="name"><b>Do dátomu</b></label><br>
                            @if(Session::get("end_date") != "") {!! Form::date('end_date', null, ['class' => 'form-control', 'style="margin: 5px 0 22px 0; width: 100%; ', 'type=date', 'name=end_date', 'value=Session::get("end_date")'  ]) !!}
                            @else {!! Form::date('end_date', null, ['class' => 'form-control', 'style="margin: 5px 0 22px 0; width: 100%; ', 'type=date', 'name=end_date', 'value=""'  ]) !!}
                            @endif
                        </div>
                        <div class=""><br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="btn effect01" type="submit" name="submit" value="Filtrovať podla informácii"><br>
                        </div>
                    </div>
                </div>


                <div class="col-xs-4 col-sm-4 col-md-4">
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




























            <br><hr>






            <div class="container">
                <h2>Skončené eventy</h2>

                <li class="table-header">
                    <div class="col col-1">Názov</div>
                    <div class="col col-2">Začiatok eventu</div>
                    <div class="col col-3">Koniec eventu</div>
                    <div class="col col-4">
                        @auth
                            @if(Auth::User()->role==0)

                                <a class="btn effect01" href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 0, "id" => Auth::user()->id, "admin" => -1])  }}" role="button"><span>Moje minulé eventy</span></a></div>
                    @endif
                    @endauth
                </li>

                @foreach($passedevents as $event)
                    @if($event->ishidden==false || Auth::user()->role==4)

                        <li class="table-row">
                            <div class="col col-1">{{$event-> event_name}}</div>
                            <div class="col col-2">{{$event-> start_date}}</div>
                            <div class="col col-3">{{$event-> end_date}}</div>
                            <div class="col col-4">
                                <a class="btn-1" href="{{ action("EventsController@showEventInfo",  ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button" target="_blank">Detaily</a>

                                @auth
                                    @if(Auth::user()->role==4)
                                        | <a class="btn-1" href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1, "userid" => -1, "admin" => -1]) }}" role="button" target="_blank">Editovať</a>
                                        | <a class="btn-1" href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}" role="button" target="_blank">Mazať</a>
                                        @if($event->ishidden == false)
                                            | <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}" role="button" target="_blank">Skryť</a>
                                        @elseif($event->ishidden == true)
                                            | <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}" role="button" target="_blank">Odkryť</a>
                                        @endif
                                    @endif
                                @endauth



                            </div>
                        </li>

                    @endif
                @endforeach



            </div>




            <br><br><hr><br><br>




            <div class="container">
                <h2>Prebiehajúce eventy</h2>

                <li class="table-header">
                    <div class="col col-1">Názov</div>
                    <div class="col col-2">Začiatok eventu</div>
                    <div class="col col-3">Koniec eventu</div>
                    <div class="col col-4">
                        @auth
                            @if(Auth::User()->role==0)

                                <a class="btn effect01" href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 1, "id" => Auth::user()->id, "admin" => -1])  }}" role="button"><span>Moje súčasné eventy</span></a></div>
                    @endif
                    @endauth
                </li>

                @foreach($activeevents as $event)
                    @if($event->ishidden==false || Auth::user()->role==4)

                        <li class="table-row">
                            <div class="col col-1">{{$event-> event_name}}</div>
                            <div class="col col-2">{{$event-> start_date}}</div>
                            <div class="col col-3">{{$event-> end_date}}</div>
                            <div class="col col-4">
                                <a class="btn-1" href="{{ action("EventsController@showEventInfo",  ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button" target="_blank">Detaily</a>

                                @auth
                                    @if(Auth::user()->role==4)
                                        | <a class="btn-1" href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1, "userid" => -1, "admin" => -1]) }}" role="button" target="_blank">Editovať</a>
                                        | <a class="btn-1" href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}" role="button" target="_blank">Mazať</a>
                                        @if($event->ishidden == false)
                                            | <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}" role="button" target="_blank">Skryť</a>
                                        @elseif($event->ishidden == true)
                                            | <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}" role="button" target="_blank">Odkryť</a>
                                        @endif
                                    @endif
                                @endauth


                            </div>
                        </li>


                    @endif
                @endforeach

            </div>


            <br><br><hr><br><br>


            <div class="container">
                <h2>Nadchádzajúce eventy</h2>

                <li class="table-header">
                    <div class="col col-1">Názov</div>
                    <div class="col col-2">Začiatok eventu</div>
                    <div class="col col-3">Koniec eventu</div>
                    <div class="col col-4">
                        @auth
                            @if(Auth::User()->role==0)

                                <a class="btn effect01" href="{{ action("EventsController@showEventsHistory",
                                    ["value" => 2, "id" => Auth::user()->id, "admin" => -1])  }}" role="button"><span>Moje budúce eventy</span></a></div>
                    @endif
                    @endauth
                </li>

                @foreach($futureevents as $event)
                    @if($event->ishidden==false || Auth::user()->role==4)

                        <li class="table-row">
                            <div class="col col-1">{{$event-> event_name}}</div>
                            <div class="col col-2">{{$event-> start_date}}</div>
                            <div class="col col-3">{{$event-> end_date}}</div>
                            <div class="col col-4">
                                <a class="btn-1" href="{{ action("EventsController@showEventInfo",  ["id" => $event->id, "param" => "-1", "userid" => "-1", "admin" => "-1"]) }}" role="button" target="_blank">Detaily</a>

                                @auth

                                    @if($event->userid == $authuser->id || Auth::user()->role==4)
                                        | <a class="btn-1" href="{{ action("EventsController@showEditEvent", ["id" => $event->id, "param" => -1, "userid" => -1, "admin" => -1]) }}" role="button" target="_blank">Editovať</a>
                                        | <a class="btn-1" href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}" role="button" target="_blank">Mazať</a>
                                        @if(Auth::user()->role==4)
                                            @if($event->ishidden == false)
                                                | <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 1]) }}" role="button" target="_blank">Skryť</a>
                                            @elseif($event->ishidden == true)
                                                | <a class="btn-1" href="{{ action("EventsController@hideEventAction", ["id" => $event->id, "value" => 0]) }}" role="button" target="_blank">Odkryť</a>
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
                                                | <a class="btn-1" href="{{ action("EventsController@addUserToEvent", ["id" => $event->id]) }}" role="button" target="_blank">Zúčastniť sa</a>
                                            @else
                                                | <a class="btn-1" href="{{ action("EventsController@removeUserFromEvent", ["id" => $event->id]) }}" role="button" target="_blank">Zrušiť účasť</a>
                                            @endif
                                        @endif
                                    @endif






                                @endauth
                            </div>
                        </li>

                    @endif
                @endforeach

            </div>







            <br><br><br>



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
