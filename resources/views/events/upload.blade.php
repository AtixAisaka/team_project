@extends("layouts.app")
@section('content')
<!--  <h3>Uplaod pre event: {{$eventName}}</h3> -->
<link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
<div class="container">
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('warnning'))
    <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
@endif


    <form method="post" action="{{action('EventsController@uploadImage')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image"><h2><b>Upload Image File</b></h2></label>
            <h4><input type="file" class="form-control-file" name="image"></h4><br>
        </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="event" value="{{$event->id}}">
        <input type="hidden" name="userId" value="{{$userId}}">
        <button type="submit" class="btn effect01" style="width: 250px">Upload Image</button>
    </form>
</div>
@endsection
