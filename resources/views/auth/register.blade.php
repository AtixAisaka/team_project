@extends('layouts.app')


@section('content')








    <div class="container">

        <div class="col-md-8">
            <h1>Registrácia</h1>
            <p>Prosím vyplňte nasledujúce údaje pre vytvorenie účtu.</p>
            <hr>

            <form method="POST" action="{{ route('register') }}">
                @csrf






                <label for="name"><b>Name</b></label><br>
                <input id="name" type="text" style="margin: 5px 0 22px 0; width: 40%; " placeholder="Meno užívatela" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong><br>
            </span>
                @enderror





                <label for="email"><b>Email</b></label><br>
                <input id="email" type="email" style="margin: 5px 0 22px 0; width: 40%; " placeholder="Email adresa" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong><br>
            </span>
                @enderror





                <label for="psw"><b>Password</b></label><br>
                <input id="password" style="margin: 5px 0 22px 0; width: 40%; " type="password" placeholder="Heslo" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong><br>
            </span>
                @enderror




                <label for="psw-repeat"><b>Repeat Password</b></label><br>
                <input id="password-confirm" style="margin: 5px 0 22px 0; width: 40%; " placeholder="Zopakujte heslo" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                <input id="role" type="hidden" name="role" value="0">

                <hr>

                <button type="submit" class="registerbtn">Zaregistrovať</button>


        </div>
    </div>















@endsection


