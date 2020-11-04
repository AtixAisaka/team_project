@extends("layouts.app")
@section('content')
<!--  <h3>Uplaod pre event: {{$eventName}}</h3> -->
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('warnning'))
    <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
@endif
    <form method="post" action="{{action('EventsController@uploadImage')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Upload Image File:</label>
            <input type="file" class="form-control-file" name="image">
        </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
           <input type="hidden" name="event" value="{{$event->id}}">
        <input type="hidden" name="userId" value="{{$userId}}">
        <button type="submit" class="btn btn-primary mb-2">Upload Image</button>
    </form>
</body>
@endsection
