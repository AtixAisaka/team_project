@extends("layouts.app")
@section('content')
    <link href="{{ asset('css/sol.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('js/sol.js') }}"></script>
    <form method="post" action="{{action('EventsController@eventaddTagInfo')}}">


            tagy
            <select id="tags0"  name="tag[]" multiple="multiple">

                    @foreach($alltags as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
            </select>



    &nbsp;<br/>
        <input type="hidden" name="idevent" value="{{$event->id}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" name="submit" value="Pridať tagy"><br>
    <table class="table">
        <h3>Zoznam tagov udalosti: {{$event->event_name}}</h3>
        <thead>
        <tr>
            <th scope="col">meno</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $row)
            <tr>
                <td>{{$row->name}}</td>
                <td><a href="{{action('EventsController@deletetagInfo',['id' => $row->id, 'idevent' => $event->id])}}">Vymazať</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        <script type="text/javascript">
            $(function() {
                // initialize sol
                $('#tags0').searchableOptionList();
            });
        </script>
@endsection
