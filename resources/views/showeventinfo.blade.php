@extends("layouts.app")
@section('content')
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    </head>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="breadcrumb">
                <table>
                    <tr>
                        <td> <h3>Event: {{$event->event_name}}</h3></td>
                    </tr>
                    <tr>
                        <td> <h3>Počet zúčastnených: {{$count}}</h3></td>
                    </tr>
                </table>
            </div>
            <div class="breadcrumb">
                <table>
                    <tr>
                        <td><h3>Mená zúčastených: </h3></td>
                    </tr>
                    <tr>
                        <td><h3>{{$usersgoing}}</h3></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col text-center">
            <a class="btn btn-primary btn-lg" href="{{ route('eventlist') }}" role="button">Späť</a>
        </div>
    </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection
