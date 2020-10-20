@extends("layouts.app")
@section('content')
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>
    <div class="container">

        <div class="panel panel-primary">

            <div class="panel-body">


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

                    <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="userid" value="{{$user -> id}}">
                        <input type="submit" name="submit" value="Pridať event"><br>
                    </div>
                </div>
            </form>

            </div>



        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
