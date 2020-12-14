@extends("layouts.app")
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <div class="container">
        <div class="row justify-content-md-center">


            <div class="col-xs-3 col-sm-3 col-md-3">

                <form method="post" action="{{action('EventsController@edittagAction')}}">


                    <label for="name"><h4><b>Edit tag</b></h4></label><br>
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="text" name="tag_name" style="margin: 5px 0 22px 0; width: 100%; " class="form-control" value="{{$tag_name}}">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <input class="btn effect01" type="submit" name="submit" value="Uložiť"><br>

                </form>



            </div>

        </div>
    </div>




    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
