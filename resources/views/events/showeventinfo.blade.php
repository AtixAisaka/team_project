@extends("layouts.app")
@section('content')
    <script src="cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js.map"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/imageview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/show_event_info.css')}}">

    <script>
        function myFunction(f) {
            f.classList.toggle("fa-eye-slash");
            var x = document.getElementById("myDIV");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

        function hidePictures(f) {
            f.classList.toggle("fa-eye-slash");
            var x = document.getElementById("pictureGallery");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

        function hide(f) {
            f.classList.toggle("fa-eye-slash");
            var x = document.getElementById("fileGallery");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>

    <div class="container details">
        <div class="flex-container first">
            <div class="flex-child">
                <div class="div_img">
                    @if($event->display_image != "none")
                        <img src="{{ url('/') }}/storage/images/users/{{ $event-> display_image }}">
                    @else
                        <img style="margin: 5px;height: 202px" src="{{asset('img/calendar.png')}}">
                        @endif</a>
                </div>
            </div>
            <div class="flex-child">
                <div style="font-size: 30px;margin-top: 10px;font-weight: bold">
                    {{$event->event_name}}
                </div>
                <div style="font-size: 20px;font-weight: bold">
                    {{$eventabout}}
                </div>
                <div style="font-size: 20px">
                    {{$eventsdescription}}
                </div>
            </div>
        </div>

        <div class="container">
            <div class="outerDiv">
                <div class="leftDiv">
                    <div class="flex-container">
                        <div class="flex-child">
                            <div class="icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div>
                        <div class="flex-child">
                            <div class="info">
                                <strong>Miesto konania: </strong>{{$event->event_place}}
                            </div>
                        </div>
                    </div>

                    <div class="flex-container">
                        <div class="flex-child">
                            <div class="icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="flex-child">
                            <div class="info">
                                <strong>Od:</strong> {{\Carbon\Carbon::parse($event->start_date)->format('d.m.Y H:i:s')}}
                                <strong>Do:</strong> {{\Carbon\Carbon::parse($event->end_date)->format('d.m.Y H:i:s')}}
                            </div>
                        </div>
                    </div>

                    <div class="flex-container">
                        <div class="flex-child">
                            <div class="icon">
                                <i class="fa fa-user-circle"></i>
                            </div>
                        </div>
                        <div class="flex-child">
                            <div class="info">
                                <strong>Organizátor:</strong> {{$eventowner}}
                            </div>
                        </div>
                    </div>

                    <div class="flex-container">
                        <div class="flex-child">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                        <div class="flex-child">
                            <div class="info">
                                <strong>Obsadenie:</strong> {{$count}}/{{$max_percipient}} <i onclick="myFunction(this)" class="fa fa-eye"></i>
                            </div>
                            <div id="myDIV">
                                <div style="font-size: 18px">
                                <strong>Mená:</strong> {{$usersgoing}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-container">
                        <div class="flex-child">
                            <div class="icon">
                                <i class="fa fa-tags"></i>
                            </div>
                        </div>
                        <div class="flex-child">
                            <div class="info">
                                <strong>Tagy:</strong> {{$eventtags}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rightDiv">

                    <div class="share_text">
                        <i class="fa fa-share-alt-square"></i>
                        <strong>Zdieľaj udalosť</strong>
                    </div>

                    <div id="share-buttons">
                        <!-- Email -->
                        <a href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://www.ukf.sk/verejnost/aktuality/kalendar">
                            <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
                        </a>
                        <!-- Facebook -->
                        <a href="http://www.facebook.com/sharer.php?u=http://85.248.137.68" target="_blank">
                            <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                        </a>
                        <!-- LinkedIn -->
                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://85.248.137.68" target="_blank">
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
                        <a href="http://reddit.com/submit?url=http://85.248.137.68&amp;title=Udalosť v kalendári" target="_blank">
                            <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
                        </a>
                        <!-- Twitter -->
                        <a href="https://twitter.com/share?url=http://85.248.137.68&amp;text=Schedule%20Tap&amp;hashtags=scheduletap" target="_blank">
                            <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                        </a>
                    </div>

                    <div class="share_text">
                        <i class="fa fa-download"></i>
                        <strong>Stiahnuť udalosť</strong>
                        <div>
                            <a href="{{ action("EventsController@makeEventPDF", ["id" => $event->id]) }}">
                                <img class="img_icon" src="{{asset('img/pdf_icon.png')}}">
                            </a>
                            <a href="{{ action("EventsController@exportIcs", ["id" => $event->id]) }}">
                                <img class="img_icon" src="{{asset('img/ics_icon.png')}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            @auth
                <div class="upload_options">
                    @if($value == 1)
                        <hr style="border: 1px solid #333334">
                    <div style="text-align: center;">
                        <a style="margin-right: 10px" href="{{ action("EventsController@openImageUpload", ["id" => $event->id]) }}">
                            <img class="img_icon" src="{{asset('img/photo_upload_icon.png')}}">Upload Obrázkov
                        </a>
                        <a href="{{ action("EventsController@openFileUpload", ["id" => $event->id]) }}" >
                            <img class="img_icon" src="{{asset('img/file_upload_icon.png')}}">Upload Súborov
                        </a>
                    </div>

                    <div>
                        <div style="font-size: 20px; font-weight: bold">
                            Obrázky udalosti <i onclick="hidePictures(this)" class="fa fa-eye"></i>
                        </div>
                        <div style="display: none;">{{$data = 0}} </div>
                        <div id="pictureGallery" style="display:none;">
                            @foreach($eventsImages as $eventImage)
                                <div class="gallery files">
                                    <div style="display: none;" id="hidden-content-{{$data}}" >
                                        <img style="max-width: 70vmax; " src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></div>
                                    <a data-fancybox data-src="#hidden-content-{{$data}}" href="javascript:;"><img width="250px" height="150px" style="border-radius: 5px" src="{{ url('/') }}/storage/images/users/{{ $eventImage->image }}"></a>
                                    @if(Auth::User()->id == $eventImage->user_id || Auth::User()->role == 4)
                                        <a href="{{ action("EventsController@deleteImage",
                                        ["id" => $eventImage->id, "eventid" => $event->id, "param" => $param,
                                         "userid" => $userid, "admin" => $admin]) }}" role="button">
                                            <div style="text-align: center;background-color: #919191;border-radius: 5px;margin-top: 10px;">
                                                Vymazať<i class="material-icons">delete</i>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                <div style="display: none;">{{$data++}}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="files" style="margin-top: 20px;clear: left">
                        <div style="font-size: 20px; font-weight: bold">
                            Súbory udalosti <i onclick="hide(this)" class="fa fa-eye"></i>
                        </div>
                        <div id="fileGallery" style="display:none;">
                            @foreach($eventsfiles as $eventsfile)
                                <div class="gallery files" style="text-align: center">
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
                                        <a href="{{ action("EventsController@deletefile",
                                        ["id" => $eventsfile->id, "eventid" => $event->id, "param" => $param,
                                         "userid" => $userid, "admin" => $admin]) }}" role="button">
                                            <div style="padding-top: 5px">
                                                <i class="material-icons">delete</i>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endif
            @endauth
        </div>
    </div>


    <div class="container" style=" display: flex; justify-content: center; align-items: center; ">
        @if($param != -1)
            <a class="btn effect01" style="width: 100px;" href="{{ action("EventsController@showEventsHistory",
                    ["value" => $param, "id" => $userid, "admin" => $admin])  }}" role="button">Späť</a>
        @endif
    </div>


@endsection
