@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <form method="post" action="{{action('EventsController@eventaddTagInfo')}}">

        <div class="container border border-dark">

            <h2>Zoznam tagov udalosti: {{$event->event_name}}</h2>
            @foreach($tags as $row)
            <li class="table-row">
                <div class="col col-1">{{$row->name}}</div>
                <div class="col col-3">  <a class="btn-1" href="{{action('EventsController@deletetagInfo',['id' => $row->id, 'idevent' => $event->id])}}" role="button" target="_blank">Vymazať</a></div>
            </li>
            @endforeach



            <h3>Pridať tagy</h3>
            <br>
            <div class="col-xs-3 col-sm-3 col-md-3">
            <select id="tags0"  name="tag[]" multiple="multiple">

                @foreach($alltags as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach

            </select>
            </div>


            <div class="col-xs-3 col-sm-3 col-md-3">
            <input type="hidden" name="idevent" value="{{$event->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input class="btn effect01" type="submit" name="submit" value="Pridať tagy"><br>
            </div>


        </div>







        <script type="text/javascript">
            $(function() {
                // initialize sol
                $('#tags0').searchableOptionList();
            });
        </script>
@endsection
