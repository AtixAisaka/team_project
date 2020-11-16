@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile_edit.css')}}">

    <div class="container mt-5 mb-5">
        <div class="row">

            <div class="col-md-3 border-right">
            </div>

            <div class="col-md-5 border-right">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf

                        @if(session("success"))
                            <div class="alert alert-success" role="alert">
                                {{session("success")}}
                            </div>
                        @endif
                        <div class="p-3 py-5">

                            <div><h1 style="font-size: 40px">Edit Your Profile</h1></div>
                            <hr>
                            <div class="header">
                                <div class="header-avatar" ><img src="{{asset('img/img_avatar.png')}}" alt="Avatar" class="avatar"></div>
                                <div class="header-col1">
                                    <span>
                                        <b>Profile Photo</b><br>
                                        Accepted file type .png .jpg<br><br>
                                        <a style="color: rgb(76, 175, 80)" href="">Upload</a>
                                    </span>
                                </div>
                            </div>
                            <hr>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="label-first-row">{{ __('NAME') }}</label>
                                    <input id="name" value="{{$user['name']}}" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="label-first-row">{{ __('SURNAME') }}</label>
                                    <input id="surname" value="{{ __('Priezvisko') }}" type="text" class="form-control @error('surname') is-invalid @enderror"
                                           name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('AGE') }}</label>
                                    <input id="age" value="{{ __('30') }}" type="text" class="form-control @error('age') is-invalid @enderror"
                                           name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('EMAIL') }}</label>
                                    <input id="email" value="{{$user['email']}}" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('PHONE') }}</label>
                                    <input id="phone" value="{{ __('30') }}" type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('COUNTRY') }}</label>
                                    <input id="country" value="{{ __('Slovakia') }}" type="text" class="form-control @error('country') is-invalid @enderror"
                                           name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('UNIVERSITY') }}</label>
                                    <input id="university" value="{{ __('UKF') }}" type="text" class="form-control @error('university') is-invalid @enderror"
                                           name="university" value="{{ old('university') }}" required autocomplete="university" autofocus>
                                    @error('university')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="mt-5 text-center">
                                <button type="submit" class="registerbtn">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
            </div>
        </div>
    </div>
@endsection
