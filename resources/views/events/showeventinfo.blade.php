@extends("layouts.app")
@section('content')
    <script src="cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js.map"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/imageview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/show_event_info.css')}}">
    <div class="container">

            <div class="col">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <h3><b>Názov: </b><br>{{$event->event_name}}</h3><hr>
                        <h3><b>Zakladatel:</b><br> {{$eventowner}} </h3><hr>
                        <h3><b>Miesto konania:</b><br> {{$event->event_place}} </h3><hr>
                        <h3><b>Typ eventu:</b><br>{{$eventabout}} </h3><hr>
                        <h3><b>Od:</b><br> {{\Carbon\Carbon::parse($event->start_date)->format('d.m.Y H:i:s')}} </h3>
                        <h3><b>Do:</b><br> {{\Carbon\Carbon::parse($event->end_date)->format('d.m.Y H:i:s')}} </h3><hr>
                </div>


                <div class="col-xs-3 col-sm-3 col-md-3" style="margin-left: 100px">
                    <h3><b>Počet zúčastnených:</b> {{$count}}/{{$max_percipient}}</h3><hr>
                    <h3><b>Mená zúčastených:</b> </h3>
                    <h4>{{$usersgoing}}</h4>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3" style="margin-left: 100px">
                    <h3><b>Tagy: </b><br>{{$eventtags}}</h3><hr>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3" style="margin-left: 100px">
                    <h3><b>Zdieľaj udalosť:</b> </h3>
                    <div id="social-links">
                        <div id="social-links">
                            <ul>
                                <div id="share-buttons">
                                    <!-- Email -->
                                    <a href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://www.ukf.sk/verejnost/aktuality/kalendar">
                                        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
                                    </a>

                                    <!-- Facebook -->
                                    <a href="http://www.facebook.com/sharer.php?u=https://www.ukf.sk/verejnost/aktuality/kalendar" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                                    </a>


                                    <!-- LinkedIn -->
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.ukf.sk/verejnost/aktuality/kalendar" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                                    </a>

                                    <!-- Pinterest -->
                                    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                        <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
                                    </a>

                                    <!-- Print -->
                                    <a href="javascript:;" onclick="window.print()">
                                        <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
                                    </a>

                                    <!-- Reddit -->
                                    <a href="http://reddit.com/submit?url=https://www.ukf.sk/verejnost/aktuality/kalendar&amp;title=Udalosť v kalendári" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
                                    </a>

                                    <!-- Twitter -->
                                    <a href="https://twitter.com/share?url=https://www.ukf.sk/verejnost/aktuality/kalendar&amp;text=Schedule%20Tap&amp;hashtags=scheduletap" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                                    </a>

                                </div>
                            </ul>
                        </div>
                    </div>

                    <a class="btn effect01" href="{{ action("EventsController@makeEventPDF", ["id" => $event->id]) }}" role="button">
                        <div class="valign-center"> <i class="material-icons">
                            </i> Uložiť ako PDF
                        </div></a>
                    <a class="btn effect01" href="{{ action("EventsController@exportIcs", ["id" => $event->id]) }}" role="button">
                        <div class="valign-center"> <i class="material-icons">
                            </i> Uložiť ako ics
                        </div></a>
            </div>


    </div></div>


    <div class="container" style=" display: flex; justify-content: center; align-items: center; ">
        @if($param != -1)
            <a class="btn effect01" style="width: 100px;" href="{{ action("EventsController@showEventsHistory",
                    ["value" => $param, "id" => $userid, "admin" => $admin])  }}" role="button">Späť</a>
        @endif
    </div>


            @auth
            <div class="container" style="  align-self: center;-webkit-align-self: center; " >

            @if($value == 1)
                    <a class="btn effect01" style="width: 250px" href="{{ action("EventsController@openImageUpload", ["id" => $event->id]) }}" role="button">
                        <div class="valign-center">Upload Obrázkov</div></a>
                         <h3><b>Obrázky udalosti:</b></h3>
                    <div style="display: none;">{{$data = 0}} </div>
                    @foreach($eventsImages as $eventImage)

                        <div class="gallery">
                            <div style="display: none;" id="hidden-content-{{$data}}" >
                                <img style="max-width: 70vmax; " src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></div>
                                <a data-fancybox data-src="#hidden-content-{{$data}}" href="javascript:;"><img width="250px" height="150px" style="border-radius: 5px" src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></a>
                            @if(Auth::User()->id == $eventImage->user_id || Auth::User()->role == 4)
                        <br> <a class="btn effect01" style="max-width: 250px; margin-top: 5px" href="{{ action("EventsController@deleteImage",
                                        ["id" => $eventImage->id, "eventid" => $event->id, "param" => $param,
                                         "userid" => $userid, "admin" => $admin]) }}" role="button">Vymazať</a>
                            @endif
                        </div>
                        <div style="display: none;">{{$data++}}</div>
                        @endforeach
            </div>
            @endif
            @endauth


                @auth
                    <div class="container" style="  align-self: center;-webkit-align-self: center; " >

                        @if($value == 1)
                            <a class="btn effect01" style="width: 250px" href="{{ action("EventsController@openFileUpload", ["id" => $event->id]) }}" role="button">
                                <div class="valign-center">Upload Súborov</div></a>
                            <h3><b>Súbory udalosti:</b></h3>


                            @foreach($eventsfiles as $eventsfile)

                                <div class="gallery">
                                 <p>{{ $eventsfile->file }}</p>
                                    <a href="{{ url('/') }}/storage/files/users/{{ $eventsfile->file }}">
                                        @if(pathinfo( url('/').'/storage/files/users/'.$eventsfile->file , PATHINFO_EXTENSION) == 'xlsx')
                                            <img src="{{ url('/') }}/img/files/xlsx.png">
                                        @elseif(pathinfo( url('/').'/storage/files/users/'.$eventsfile->file , PATHINFO_EXTENSION) == 'docx')
                                            <img src="{{ url('/') }}/img/files/docx.png">
                                        @elseif(pathinfo( url('/').'/storage/files/users/'.$eventsfile->file , PATHINFO_EXTENSION) == 'pdf')
                                            <img src="{{ url('/') }}/img/files/pdf.png">
                                        @elseif(pathinfo( url('/').'/storage/files/users/'.$eventsfile->file , PATHINFO_EXTENSION) == 'mp4')
                                            <img src="{{ url('/') }}/img/files/mp4.png">
                                        @else
                                            <img src="{{ url('/') }}/img/files/unknown.png"> @endif
                                    </a>
                                    @if(Auth::User()->id == $eventsfile->user_id || Auth::User()->role == 4)
                                        <br> <a class="btn effect01" style="max-width: 250px; margin-top: 5px" href="{{ action("EventsController@deletefile",
                                        ["id" => $eventsfile->id, "eventid" => $event->id, "param" => $param,
                                         "userid" => $userid, "admin" => $admin]) }}" role="button">Vymazať</a>
                                    @endif
                                </div>
                            @endforeach

                        @endif
                        @endauth

        </div>










@endsection
