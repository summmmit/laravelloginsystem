@extends('layout.main')

@section('content')

<form action="{{ URL::route('account-sign-in-post') }}" method="post">
<div class="field">
Username<input type="text" name="username" {{ (Input::old('username')) ? 'value = "' .e(Input::old('username')). '" ':'' }}><br>
@if($errors->has('username'))
{{ $errors->first('username') }}
@endif
</div>
<div class="field">
passowrd<input type="password" name="password"><br>
@if($errors->has('password'))
{{ $errors->first('password') }}
@endif
</div>
<div class="field">
<input type="checkbox" name="remember" id="remember">Remember
</div>
<input type="submit" value="submit">
{{ Form::token() }}
</form>

@stop