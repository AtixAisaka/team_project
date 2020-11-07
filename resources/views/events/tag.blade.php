@extends("layouts.app")
@section('content')
    <a href="#">add Tag</a>
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
        <td><a href="#">Delete Tag</a><td><a href="#">Edit Tag</a></td>
    </tr>
    @endforeach
    </tbody>
    </table>
@endsection
