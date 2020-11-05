@extends("layouts.app")
@section('content')
    <div class="container">
            @auth
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

                        <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="userid" value="{{$user -> id}}">
                            <input type="hidden" name="helper" value="0">
                            <input type="submit" name="submit" value="Pridať event"><br>
                        </div>
                    </div>
                </form>
            </div>
        @endauth



        <div class="breadcrumb">
            <div class="panel-heading">Informácie eventu</div>
                {!! $calendar_details->calendar() !!}

            </div>
    </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar_details->script() !!}
@endsection
