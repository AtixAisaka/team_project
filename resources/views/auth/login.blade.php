@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                <input id="password" style="margin: 5px 0 5px 0; width: 40%; " type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong><br>
            </span>
                @enderror
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: rgb(76, 175, 80);">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif


                <div class="checkbox">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="registerbtn">Login</button>
                <hr>
                <div class="login_links">
                    <div>
                    <a href="{{url('/')}}/login/github" class="btn github"><i class="fa fa-github-square"></i> Connect with Github</a>
                    </div>
                    <div>
                    <a href="{{url('/')}}/login/facebook" class="btn facebook"><i class="fa fa-facebook-square"></i> Connect with Facebook</a>
                    </div>
                    <div>
                    <a href="{{url('/')}}/login/google" class="btn google"><i class="fa fa-google-plus-square"></i> Connect with Google</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


