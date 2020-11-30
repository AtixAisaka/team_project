@extends('layouts.app')

@section('content')

    <div class="container" style="display: flex;justify-content: center;">
        <div class="card" style="min-width: 500px; clear:both;">
            <div class="card-header" style="text-align: center"><h1>Reset Password</h1></div>
            <hr>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="registerbtn">
                            {{ __('Send Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
