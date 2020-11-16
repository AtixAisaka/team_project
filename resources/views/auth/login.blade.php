@extends('layouts.app')


@section('content')

    <div class="container">

        <div class="col-md-8">
            <h1>Login</h1>
            <p>Please fill in this form to login.</p>
            <hr>

            <form method="POST" action="{{ route('login') }}">
                @csrf



                <label for="email"><b>Email</b></label><br>
                <input id="email" type="email" style="margin: 5px 0 22px 0; width: 40%; " placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong><br>
            </span>
                @enderror





                <label for="psw"><b>Password</b></label><br>
                <input id="password" style="margin: 5px 0 22px 0; width: 40%; " type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong><br>
            </span>
                @enderror


                <div class="checkbox">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>


                <hr>

                <button type="submit" class="registerbtn">Login</button>


                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: rgb(76, 175, 80)">
                        {{ __('Forgot Your Password?') }}
                    </a>
            @endif


        </div>
    </div>















@endsection


