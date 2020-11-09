@extends("layouts.app")
@section('content')
    <a href="{{action('EventsController@addtagsView')}}">add Tag</a>
    <table class="table">
    <thead>
    <tr>
        <th scope="col">name</th>

    </tr>
    </thead>
    <tbody>
    @foreach($user_Tags as $row)
    <tr>
        <td>{{$row->name}}</td>
        <td><a href=" {{action('EventsController@deletetag', ["id" => $row->id])}}">Delete Tag</a><td><a href="{{action('EventsController@editTagView', ["id" => $row->id])}}">Edit Tag</a></td>
    </tr>
    @endforeach
    </tbody>
    </table>

@endsection
