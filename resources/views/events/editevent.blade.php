@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
        <div class="breadcrumb">

                <form method="post" action="{{action('EventsController@updateEventAction', ["id" => $event->id])}}">
                    Nazov eventu:<br>
                    <input type="text" name="event_name" value="{{ $event->event_name }}"><br>
                    Od:<br>
                    <input type="text" name="start_date" value="{{ $event->start_date }}"><br>
                    Do:<br>
                    <input type="text" name="end_date" value="{{ $event->end_date }}"><br>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="param" value="{{$param}}">
                    <input type="hidden" name="userid" value="{{$userid}}">
                    <input type="hidden" name="admin" value="{{$admin}}">
                    <input type="submit" name="submit" value="Uložiť"><br>
                </form>
        </div>
    </div>
    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
