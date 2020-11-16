@extends("layouts.app")
@section('content')
    <script src="cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <link href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js.map"></script>
    <div class="container">



            <div class="col">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <h3><b>Názov: </b><br>{{$event->event_name}}</h3><hr>
                        <h3><b>Zakladatel:</b><br> {{$eventowner}} </h3><hr>
                        <h3><b>Miesto konania:</b><br> {{$event->event_place}} </h3><hr>
                        <h3><b>Typ eventu:</b><br>{{$eventabout}} </h3><hr>
                        <h3><b>Od:</b> {{$event->start_date}} </h3>
                        <h3><b>Do:</b> {{$event->end_date}} </h3>
                </div>


                <div class="col-xs-3 col-sm-3 col-md-3" style="margin-left: 100px">
                    <h3><b>Počet zúčastnených:</b> {{$count}}</h3><hr>
                    <h3><b>Mená zúčastených:</b> </h3>
                    <h4>{{$usersgoing}}</h4>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3" style="margin-left: 100px">
                    <h3><b>Tagy:</b> </h3>
                    <h4>{{$eventtags}}</h4>
                </div>

            </div>

    </div>



            @auth
            <div class="container" style="  align-self: center;-webkit-align-self: center;">
            @if($value == 1)
                          <a href="{{ action("EventsController@openImageUpload", ["id" => $event->id]) }}">Upload Obrázkov</a><h3><b>Obrázky udalosti:</b></h3>

                        @foreach($eventsImages as $eventImage)
                            <div style="display: none;" id="hidden-content">
                                <img style="max-width: 70vmax;" src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></div><br><br>
                                <a data-fancybox data-src="#hidden-content" href="javascript:;"><img width="250px" src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></a>
                            @if(Auth::User()->id == $eventImage->user_id || Auth::User()->role == 4)
                        <br> <a class="btn effect01" style="max-width: 250px;" href="{{ action("EventsController@deleteImage",
                                        ["id" => $eventImage->id, "eventid" => $event->id, "param" => $param,
                                         "userid" => $userid, "admin" => $admin]) }}" role="button">Vymazať</a>

                            @endif

                        @endforeach



            @endif
            @endauth
        </div>




    <div class="container" style=" display: flex; justify-content: center; align-items: center; ">
            @if($param != -1)
                <a class="btn effect01" style="width: 100px;" href="{{ action("EventsController@showEventsHistory",
                    ["value" => $param, "id" => $userid, "admin" => $admin])  }}" role="button">Späť</a>
            @endif
        </div>
    </div>




@endsection
