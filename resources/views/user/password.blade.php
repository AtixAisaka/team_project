@extends('layouts.app')

@section('content')
    <div class="container" style="display: flex;justify-content: center;">
                <div class="card" style="min-width: 500px; clear:both;">
                    <div class="card-header" style="text-align: center"><h1>Change Password</h1></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @if(session("success"))
                                <div class="alert alert-success" role="alert">
                                    {{session("success")}}
                                </div>
                            @endif
                            @if(session("error"))
                                <div class="alert alert-danger" role="alert">
                                    {{session("error")}}
                                </div>
                            @endif
                            <div class="form-group row" >
                                <hr>
                                <label for="oldPassword" class="col-md-4 " >{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="oldPassword" type="password" placeholder="Enter current Password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group" style="text-align: center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="color: rgb(76, 175, 80)">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" class="form-control" placeholder="Enter new Password" id="password" name="password" required type="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm new Password" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <hr>

                            <div class="form-group" style="text-align: center">
                                    <button type="submit" class="registerbtn">
                                        {{ __('Update') }}
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
@endsection
