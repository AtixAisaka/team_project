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

                                </div>
                            </div>
                            <hr>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('NAME') }}</label>
                                    <input id="name" value="{{$user['name']}}" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('AGE') }}</label>
                                    <input id="age" value="{{$user['age']}}" type="text" class="form-control @error('age') is-invalid @enderror"
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
                                    <input id="phone" value="{{$user['phone']}}" type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="label-first-row">{{ __('COUNTRY') }}</label>
                                    <select id="country" value="{{$user['country']}}" name="country" class="form-control @error('country') is-invalid @enderror"
                                            name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                        @if ($user['country']=='Czech Republic')
                                            <option class="labels-second-row" value="Slovakia">Slovakia</option>
                                            <option class="labels-second-row" selected="selected" value="Czech Republic">Czech Republic</option>
                                            <option class="labels-second-row" value="United States">United States</option>
                                            <option class="labels-second-row" value="Hungary">Hungary</option>
                                            <option class="labels-second-row" value="Serbia">Serbia</option>
                                            <option class="labels-second-row" value="Other">Other</option>
                                        @elseif ($user['country']=='Slovakia')
                                            <option class="labels-second-row" selected="selected" value="Slovakia">Slovakia</option>
                                            <option class="labels-second-row" value="Czech Republic">Czech Republic</option>
                                            <option class="labels-second-row" value="United States">United States</option>
                                            <option class="labels-second-row" value="Hungary">Hungary</option>
                                            <option class="labels-second-row" value="Serbia">Serbia</option>
                                            <option class="labels-second-row" value="Other">Other</option>
                                        @elseif ($user['country']=='United States')
                                            <option class="labels-second-row" value="Slovakia">Slovakia</option>
                                            <option class="labels-second-row" value="Czech Republic">Czech Republic</option>
                                            <option class="labels-second-row" selected="selected" value="United States">United States</option>
                                            <option class="labels-second-row" value="Hungary">Hungary</option>
                                            <option class="labels-second-row" value="Serbia">Serbia</option>
                                            <option class="labels-second-row" value="Other">Other</option>
                                        @elseif ($user['country']=='Hungary')
                                            <option class="labels-second-row" value="Slovakia">Slovakia</option>
                                            <option class="labels-second-row" value="Czech Republic">Czech Republic</option>
                                            <option class="labels-second-row" value="United States">United States</option>
                                            <option class="labels-second-row" selected="selected" value="Hungary">Hungary</option>
                                            <option class="labels-second-row" value="Serbia">Serbia</option>
                                            <option class="labels-second-row" value="Other">Other</option>
                                        @elseif ($user['country']=='Serbia')
                                            <option class="labels-second-row" value="Slovakia">Slovakia</option>
                                            <option class="labels-second-row" value="Czech Republic">Czech Republic</option>
                                            <option class="labels-second-row" value="United States">United States</option>
                                            <option class="labels-second-row" value="Hungary">Hungary</option>
                                            <option class="labels-second-row" selected="selected" value="Serbia">Serbia</option>
                                            <option class="labels-second-row" value="Other">Other</option>
                                        @elseif ($user['country']=='Other')
                                            <option class="labels-second-row" value="Slovakia">Slovakia</option>
                                            <option class="labels-second-row" value="Czech Republic">Czech Republic</option>
                                            <option class="labels-second-row" value="United States">United States</option>
                                            <option class="labels-second-row" value="Hungary">Hungary</option>
                                            <option class="labels-second-row" value="Serbia">Serbia</option>
                                            <option class="labels-second-row" selected="selected" value="Other">Other</option>
                                        @endif </select>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

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
