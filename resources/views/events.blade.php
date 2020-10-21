@extends("layouts.app")
@section('content')
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <div class="container">

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
