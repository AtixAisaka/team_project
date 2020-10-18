@extends('layouts.app')

@section('content')
    <head>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>
    <div class="container">

        <div class="panel panel-primary">

            <div class="panel-body">

                {!! Form::open(array('route' => 'events.add','method'=>'POST','files'=>'true')) !!}
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
                            {!! Form::label('začiatok eventu','koniec eventu') !!}
                            <div class="">
                                {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::label('začiatok eventu','koniec eventu') !!}
                            <div class="">
                                {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::label('začiatok eventu','koniec eventu') !!}
                            <div class="">
                                {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                        {!! Form::submit('Pridať event',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Informácie eventu</div>
            <div class="panel-body" >
                <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

                <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang-all.js"></script>

                <script type="text/javascript">
                    $(document).ready(function(){

                        $('#calendar').fullCalendar({
                            // for v2
                            lang: 'en',
                        });
                    });
                </script>
            </div>
        </div>

    </div>
@endsection
