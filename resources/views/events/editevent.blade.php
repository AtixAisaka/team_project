@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>




    <div class="container border border-dark">
        <form method="post" action="{{action('EventsController@updateEventAction', ["id" => $event->id])}}">
        <h2>Edit eventu</h2><br>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <div class="">
                            <label for="name"><b>Názov eventu</b></label><br>
                            <input style="margin: 5px 0 22px 0; width: 100%; " class="form-control" type="text" name="event_name" value="{{ $event->event_name }}">
                        </div>
                        <div class="">
                            <label for="name"><b>Miesto konania eventu</b></label><br>
                            <input style="margin: 5px 0 22px 0; width: 100%; "type="text" name="event_place" class="form-control" value="{{$event->event_place}}">
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
                            <label for="name"><b>Od dátumu</b></label><br>
                            <input class="form-control" type="date" name="start_date" value="{{ $event->start_date }}"><br>
                        </div>
                        <div class="">
                            <label for="name"><b>Do dátumu</b></label><br>
                            <input class="form-control" type="date" name="end_date" value="{{ $event->end_date }}"><br>
                        </div>
                        <div class=""><br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="btn effect01" type="submit" name="submit" value="Uložiť"><br>
                            <a href="{{action('EventsController@eventTagInfoView', ["id" => $event->id])}}" target="_blank">edit tagov</a>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="param" value="{{$param}}">
                        <input type="hidden" name="userid" value="{{$userid}}">
                        <input type="hidden" name="admin" value="{{$admin}}">
                    </div>
                </div>

            </div>
            </form>



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
