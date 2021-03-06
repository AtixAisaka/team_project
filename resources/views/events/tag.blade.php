@extends("layouts.app")
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/previous_ongoing_next_eventbutton.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/detail_button.css')}}">
    <div class="container border border-dark">








        <div class="flex-child green" style="padding-left: 5px">
            <div class="flex-child buttons" style="width: auto; height: 50px">
                <div style="font-size: 43px">
                    Tagy

                    @auth
                        @if(Auth::user()->role!=4)
                            <a class="a_icon" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-square"></i></a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>


        @foreach($user_Tags as $row)

            <li class="table-row">
                <div class="col col-1">{{$row->name}}</div>
                <div class="col col-3">
                       <a class="btn-1" role="button" target="_blank" data-toggle="modal" data-target="#editModal{{$row->id}}">Editovať</a>
                    |  <a class="btn-1" href="{{action('EventsController@deletetag'  , ["id" => $row->id])}}"   role="button" target="_blank">Vymazať</a></div>
            </li>



















        <div class="modal fade" id="editModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Edit tag</h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{action('EventsController@edittagAction')}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                                    @elseif (Session::has('warnning'))
                                        <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                                    @endif
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-5">
                                    <div class="form-group">
                                        <label for="name"><b>Editovanie tagu: {{$row->name}}</b></label><br>
                                        <div class="">
                                            <input type="hidden" name="id" value="{{$row->id}}">
                                            <input type="text" name="tag_name" style="margin: 5px 0 22px 0; width: 100%; " class="form-control" value="{{$row->name}}">
                                        </div>
                                        <div class=""><br>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input class="btn effect01" type="submit" name="submit" value="Uložiť"><br>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavri</button>
                    </div>
                </div>
            </div>
        </div>

            @endforeach







        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Pridať tag</h3>
                    </div>
                    <div class="modal-body">

                            <div class="row justify-content-md-center">


                                <div class="col-xs-3 col-sm-3 col-md-5">

                                    <form method="post" action="{{action('EventsController@addtag')}}">


                                        <label for="name"><h4><b>Názov</b></h4></label><br>

                                        <input type="text" name="tag_name" style="margin: 5px 0 22px 0; width: 100%; " class="form-control">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        <input class="btn effect01" type="submit" name="submit" value="Uložiť"><br>

                                    </form>



                                </div>

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavri</button>
                    </div>
                </div>
            </div>
        </div>





    </div>




@endsection
