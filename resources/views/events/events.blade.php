@extends("layouts.app")
@section('content')

    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>

    <div class="container">
            @auth
            @if(Auth::User()->role!=4)
            <div class="breadcrumb">

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
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">

                        @if(Auth::User()->role == 3)
                            <input type="hidden" name="type" value="3">
                            <input type="hidden" name="idkatedry" value="0">
                            <input type="hidden" name="idfakulty" value="0">
                        @elseif(Auth::User()->role == 2)
                            fakulta
                            <select id="idfakulty" name="idfakulty">
                                <option value="">Žiadna fakulta</option>
                                @foreach($fakulty as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="type" value="2">
                            <input type="hidden" name="idkatedry" value="0">
                        @elseif(Auth::User()->role == 1)
                        <!-- Sem doplnit ten select so searchom !-->
                            Katedra
                            <select id="idkatedry" name="idkatedry" >
                                <option value="">Žiadna katedra</option>
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
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                Začiatok Eventu
                                <div class="">
                                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                Koniec Eventu
                                <div class="">
                                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                tagy
                                <select id="tags0"  name="tags0[]" multiple="multiple">
                                        @foreach($tags as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="userid" value="{{$user -> id}}">
                            <input type="hidden" name="helper" value="0">
                            <input type="submit" name="submit" value="Pridať event"><br>
                        </div>
                    </div>
                </form>
            </div>
                @endif
        @endauth


                <h3>Filtrovanie</h3>
                <form method="post" action="{{action('EventsController@filterEvents')}}">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                Podľa názvu
                                @if(Session::get("name") != "") <input type="text" name="name" value="{{Session::get("name")}}">
                                @else <input type="text" name="name" placeholder="Názov/časť názvu" value="">
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                Podľa typu
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
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                Podľa pracoviska/fakulty
                                <select id="pracovisko" name="pracovisko" >
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
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                Od dátumu
                                @if(Session::get("start_date") != "") <input type="date" name="start_date" value="{{Session::get("start_date")}}">
                                @else <input type="date" name="start_date" value="">
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                Do dátumu
                                @if(Session::get("end_date") != "") <input type="date" name="end_date" value="{{Session::get("end_date")}}">
                                @else <input type="date" name="end_date" value="">
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                Podla tagov
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
                        <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="submit" name="submit" value="Filtrovať podla informácii"><br>
                        </div>
                    </div>

        <div class="breadcrumb">
            <div class="panel-heading">Informácie eventu</div>
                {!! $calendar_details->calendar() !!}

            </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar_details->script() !!}
        <script type="text/javascript">
            $(function() {
                // initialize sol
                $('#idfakulty').searchableOptionList();
                $('#idkatedry').searchableOptionList();
                $('#tags0').searchableOptionList();
                $('#tags').searchableOptionList();
                $('#pracovisko').searchableOptionList();
                $('#type').searchableOptionList();
            });
    </script>

@endsection
