@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/edit_event.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>

    <div class="container">
        <h1>Edit eventu</h1>
        <div class="container details">
            <div class="row">
                <form method="post" action="{{action('EventsController@updateEventAction', ["id" => $event->id])}}" enctype="multipart/form-data">

                <div class="col-xs-9" style="width: 100%">
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
                            <div style="font-size: 20px;margin-top: 10px;font-weight: bold">
                                Názov: <input class="form-control" name="event_name" value="{{ $event->event_name }}">
                            </div>
                            <div style="font-size: 20px;margin-top: 10px;font-weight: bold">
                                Popis eventu: <textarea rows="4" cols="50" type="text" name="eventdescription" class="form-control">{{$eventdescription}}</textarea>
                                <input type="hidden" name="eventdescription_id" value="{{$eventdescription_id}}" >
                            </div>
                            <div>
                                <label for="image"><b>Obrázok eventu</b></label>
                                <input type="file" class="form-control-file" name="image" multiple><br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4" style="width: 50%;margin-top: 15px">
                    <div class="flex-container">
                        <div class="flex-child">
                            <div class="icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            </div>
                            <div class="flex-child">
                                <div class="info">
                                    <strong>Miesto konania: </strong>
                                    <input name="event_place" class="form-control" value="{{$event->event_place}}">
                                </div>
                            </div>
                        </div>

                        @if($event->type == 2)
                            <div class="flex-container">
                                <div class="flex-child">
                                    <div class="icon">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                </div>
                                <div class="flex-child">
                                    <div class="info">
                                        <strong>Fakulta: </strong>
                                        <select class="form-control" style="margin: 5px 0 22px 0; width: 100%; " id="idfakulty" name="idfakulty" >
                                            @foreach($fakulty as $row)
                                                @if($row->id == $event->idfakulty)) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                                @else <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @elseif($event->type == 1)
                            <div class="flex-container">
                                <div class="flex-child">
                                    <div class="icon">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                </div>
                                <div class="flex-child">
                                    <div class="info">
                                        <strong>Katedra: </strong>
                                        <select class="form-control" style="margin: 5px 0 22px 0; width: 100%; " id="idkatedry" name="idkatedry">
                                            @foreach($katedry as $row)
                                                @if($row->id == $event->idkatedry)) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                                @else <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="flex-container">
                            <div class="flex-child">
                                <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div class="flex-child">
                                <div class="info">
                                    <strong>Začiatok eventu:</strong> <input type="datetime-local" class="form-control" name="start_date" value="{{date('Y-m-d\TH:i:s', strtotime($event->start_date))}}">
                                    <strong>Koniec eventu:</strong> <input type="datetime-local" class="form-control" name="end_date" value="{{date('Y-m-d\TH:i:s', strtotime($event->end_date))}}">
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
                                    <strong>Obsadenie:</strong><input type="number" id="quantity" name="max_percipient" min="1" max="25" required class="form-control" value="{{ $event->max_percipient }}">
                                </div>
                            </div>
                        </div>

                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="param" value="{{$param}}">
                    <input type="hidden" name="userid" value="{{$userid}}">
                    <input type="hidden" name="admin" value="{{$admin}}">
                    <div style="padding-top: 10px; padding-left: 110px">
                        <input class="btn effect01" type="submit" name="submit" value="Uložiť">
                    </div>
                </div>
            </form>

                <div class="col-xs-6">
                    <form method="post" action="{{action('EventsController@eventaddTagInfo',['param' => $param, 'userid'=> $userid, 'admin'=>$admin])}}">
                        <h3><strong>Pridať tagy</strong></h3>
                        <select id="tags0"  name="tag[]" multiple="multiple" style="width: 300px;margin-bottom: 10px">
                            @foreach($alltags as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        <div>
                            <input type="hidden" name="idevent" value="{{$event->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="btn effect01" style="width: auto" type="submit" name="submit" value="Pridať tagy"><br>
                        </div>
                    </form>
                    <h3><strong>Zoznam tagov eventu</strong></h3>

                    @foreach (array_combine($eventtagids, $eventtags) as $eventtagid => $eventtag)
                        {{$eventtagid}},{{$eventtag}} <a class="a_delete" href="{{action('EventsController@deletetagInfo',['id' => $eventtagid, 'idevent' => $event->id, 'param' => $param, 'userid'=> $userid, 'admin'=>$admin])}}"><strong>X</strong></a> </br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            // initialize sol
            $('#tags0').searchableOptionList();
        });
    </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
