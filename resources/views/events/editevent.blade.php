@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>




    <div class="container border border-dark">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <h2 style="font-size: 35px">Edit eventu</h2>
                        <form method="post" action="{{action('EventsController@updateEventAction', ["id" => $event->id])}}" enctype="multipart/form-data">
                        <div class="">
                            <label for="name"><b>Meno eventu</b></label><br>
                            <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="event_name" value="{{ $event->event_name }}">
                        </div>
                        <div class="">
                            <label for="name"><b>Miesto konania eventu</b></label><br>
                            <input style="margin: 5px 0 22px 0; width: 100%; "type="text" name="event_place" class="form-control" value="{{$event->event_place}}">
                        </div>
                        <div class="">
                            <label for="name"><b>Popis eventu</b></label><br>
                            <input style="margin: 5px 0 22px 0; width: 100%; "type="text" name="eventdescription" class="form-control" value="{{$eventdescription}}">
                            <input type="hidden" name="eventdescription_id" value="{{$eventdescription_id}}" >
                        </div>
                        @if($event->type == 2)
                            <label for="name"><b>Fakulta</b></label><br>
                            <select class="form-control" style="margin: 5px 0 22px 0; width: 100%; " id="idfakulty" name="idfakulty" >
                                @foreach($fakulty as $row)
                                    @if($row->id == $event->idfakulty)) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                    @else <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @elseif($event->type == 1)
                            <label for="name"><b>Katedra</b></label><br>
                            <select class="form-control" style="margin: 5px 0 22px 0; width: 100%; " id="idkatedry" name="idkatedry">
                                @foreach($katedry as $row)
                                    @if($row->id == $event->idkatedry)) <option selected="selected" value="{{$row->id}}">{{$row->name}}</option>
                                    @else <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                        <div class="">
                            <label for="name"><b>Začiatok eventu</b></label><br>
                            <input type="datetime-local" class="form-control" name="start_date" value="{{date('Y-m-d\TH:i:s', strtotime($event->start_date))}}"><br>
                        </div>
                        <div class="">
                            <label for="name"><b>Koniec eventu</b></label><br>
                            <input type="datetime-local" class="form-control" name="end_date" value="{{date('Y-m-d\TH:i:s', strtotime($event->end_date))}}"><br>
                        </div>
                        <label for="max_percipient"><b>Maximálny počet zúčastnených</b></label><br>
                        <div class="">
                            <input type="number" id="quantity" name="max_percipient" min="1" max="25" required class="form-control" value="{{ $event->max_percipient }}">
                        </div>
                        <div class=""><br>
                        <label for="image"><b>Obrázok eventu</b></label>
                        <input type="file" class="form-control-file" name="image" multiple><br>
                        </div>

                        <div class=""><br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="btn effect01" type="submit" name="submit" value="Uložiť"><br><br>
                            <a class="btn effect01" href="{{action('EventsController@eventTagInfoView', ["id" => $event->id])}}" target="_blank">edit tagov</a>
                        </div>


                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="param" value="{{$param}}">
                        <input type="hidden" name="userid" value="{{$userid}}">
                        <input type="hidden" name="admin" value="{{$admin}}">
                        </form>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-7">
                    <div class="form-group" style="margin-left: 100px">
                        <form method="post" action="{{action('EventsController@eventaddTagInfo')}}">
                            <h2 style="font-size: 35px">Zoznam tagov eventu</h2><br>

                                <li class="table-row">
                                    <div class="col col-1"></div>
                                    <div class="col col-3">  <a class="btn-1" href="" role="button" target="_blank">Vymazať</a></div>
                                </li>




                            <h3>Pridať tagy</h3>
                            <br>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <select id="tags0"  name="tag[]" multiple="multiple">


                                        <option value=""></option>


                                </select>
                            </div>


                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <input type="hidden" name="idevent" value="">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="btn effect01" type="submit" name="submit" value="Pridať tagy"><br>
                            </div>
                        </form>
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



            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
