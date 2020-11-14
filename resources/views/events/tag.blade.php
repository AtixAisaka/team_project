@extends("layouts.app")
@section('content')
    <a href="{{action('EventsController@addtagsView')}}">Pridať tag</a>
    <table class="table">
        @if(Auth::User()->role != 4) <h3>Zoznam vlastných tagov</h3>
        @else <h3>Zoznam tagov</h3>
        @endif
    <thead>
    <tr>
        <th scope="col">meno</th><th scope="col">action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user_Tags as $row)
    <tr>
        <td>{{$row->name}}</td>
        <td><a href=" {{action('EventsController@deletetag', ["id" => $row->id])}}">Vymazať</a>
            <td><a href="{{action('EventsController@editTagView', ["id" => $row->id])}}">Editovať</a></td>
    </tr>
    @endforeach
    </tbody>
    </table>

@endsection
