@extends("layouts.app")
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <div class="container border border-dark">








        @if(Auth::User()->role != 4) <h3>Zoznam vlastných tagov</h3> <a href="{{action('EventsController@addtagsView')}}">Pridať tag</a>
        @else <h3>Zoznam tagov</h3>
        @endif


    @foreach($user_Tags as $row)

          <li class="table-row">
              <div class="col col-1">{{$row->name}}</div>
              <div class="col col-3">
                  <a class="btn-1" href="{{action('EventsController@editTagView', ["id" => $row->id])}}" role="button" target="_blank">Editovať</a>
              |  <a class="btn-1" href="{{action('EventsController@deletetag'  , ["id" => $row->id])}}"   role="button" target="_blank">Vymazať</a></div>
           </li>






    @endforeach



    </div>

@endsection
