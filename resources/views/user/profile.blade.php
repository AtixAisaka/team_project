@extends("layouts.app")
@section('content')
<div class="container">
    <h1>Používateľský profil</h1>
    <h2>{{$user["name"]}}</h2>
    <h3>{{$user["email"]}}</h3>
    <h3>{{$user["role"]}}</h3>
    <div class="form-group">
        <a class="button" href="{{route("password.edit",Auth::user()->id)}}">zmena hesla</a>
        <a class="button" href="{{route("user.edit",Auth::user()->id)}}">úprava profilu</a>
    </div>
</div>

@endsection
<script type="text/javascript">
    document.title="Profil používateľa {{$user["name"]}}";
</script>
