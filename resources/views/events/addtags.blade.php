@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="breadcrumb">

                <form method="post" action="{{action('EventsController@addtag')}}">
                    Tag Name:<br>
                    <input type="text" name="tag_name" ><br>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" name="submit" value="Uložiť"><br>
                </form>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
