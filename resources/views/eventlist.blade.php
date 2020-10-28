@extends("layouts.app")
@section('content')
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>
    @auth
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
                        <input type="hidden" name="userid" value="{{$authuser -> id}}">
                        <input type="hidden" name="helper" value="1">
                        <input type="submit" name="submit" value="Pridať event"><br>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @endauth

    <div class="container border border-dark">
        @auth
        <div class="row justify-content-center">
            <div class="col">
                <div class="text-center">
                    <a class="btn btn-primary btn" href="{{ action("EventsController@showEventsHistory", ["value" => 0])  }}" role="button">Moje minulé eventy</a>
                </div>
            </div>

            <div class="col">
                <div class="text-center">
                    <a class="btn btn-primary btn" href="{{ action("EventsController@showEventsHistory", ["value" => 1]) }}" role="button">Moje súčasné eventy</a>
                </div>
            </div>

            <div class="col">
                <div class="text-center">
                    <a class="btn btn-primary btn" href="{{ action("EventsController@showEventsHistory", ["value" => 2]) }}" role="button">Moje budúce eventy</a>
                </div>
            </div>
        </div>
        @endauth
        <div class="row justify-content-center">
            <div class="breadcrumb border border-primary">
                <div class="col">
                    <h4>Skončené eventy</h4>
                    <table>
                        @foreach($passedevents as $event)
                            <tr>
                                <td> {{$event-> event_name}} </td>
                                <td>
                                    <a href="{{ action("EventsController@showEventInfo", ["id" => $event->id]) }}">&nbsp; Detaily</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="breadcrumb border border-primary">
                <div class="col">
                    <h4>Prebiehajúce eventy</h4>
                    <table>
                        @foreach($activeevents as $event)
                            <tr>
                                <td> {{$event-> event_name}} </td>
                                <td>
                                    <a href="{{ action("EventsController@showEventInfo", ["id" => $event->id]) }}">&nbsp; Detaily</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="breadcrumb border border-primary">
                <div class="col">
                    <h4>Nadchádzajúce eventy</h4>
                    <table>
                        @foreach($futureevents as $event)
                            <tr>
                                <td> {{$event-> event_name}}</td>
                                @auth
                                    @if($event->userid == $authuser->id)
                                        <td>
                                            <a href="{{ action("EventsController@showEditEvent", ["id" => $event->id]) }}">&nbsp; Editovať</a>
                                        </td>
                                        <td>
                                            <a href="{{ action("EventsController@deleteEventAction", ["id" => $event->id]) }}">Mazať</a>
                                        </td>
                                    @else
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
                                @endauth
                                <td>
                                    <a href="{{ action("EventsController@showEventInfo", ["id" => $event->id]) }}">&nbsp; Detaily</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
