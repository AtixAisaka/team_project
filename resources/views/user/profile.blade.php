@extends("layouts.app")
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">

    {{--<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>--}}


    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
            </div>
            <div class="col-md-5 border-right">
                    <div><h1 style="font-size: 40px">Your Profile</h1></div>
                <hr>

                <div class="header">

                    <div class="header-col1">
                        <span>
                            NAME<br>
                            SURNAME<br><br>
                            PASSWORD
                        </span>
                    </div>

                    <div class="header-col2">
                        <span>
                            {{$user["name"]}}<br>
                            Priezvisko<br><br>
                            <a style="color: rgb(76, 175, 80)" href="{{route("password.edit",Auth::user()->id)}}">Change</a>
                        </span>
                    </div>

                    <div class="header-avatar" ><img src="{{asset('img/img_avatar.png')}}" alt="Avatar" class="avatar"></div>
                </div>


                <div class="p-3 py-5">
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="label-first-row">AGE</label></div>
                        <div class="col-md-6"><label class="labels-second-row">30</label></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6"><label class="label-first-row">EMAIL</label></div>
                        <div class="col-md-6"><label class="labels-second-row">{{$user["email"]}}</label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="label-first-row">PHONE</label></div>
                        <div class="col-md-6"><label class="labels-second-row">0912358479</label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="label-first-row">COUNTRY</label></div>
                        <div class="col-md-6"><label class="labels-second-row">Slovakia</label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="label-first-row">UNIVERSITY</label></div>
                        <div class="col-md-6"><label class="labels-second-row">UKF</label></div>
                    </div>
                    <hr>

                    <div class="mt-5 text-center">
                        <a href="{{route("user.edit",Auth::user()->id)}}">
                            <button  class="registerbtn"><span>{{ __('Edit') }}</span></button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

@endsection
<script type="text/javascript">
    document.title="Profil používateľa {{$user["name"]}}";
</script>
