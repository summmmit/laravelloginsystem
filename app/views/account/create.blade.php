@extends('layout.main')

@section('content')

<form action="{{ URL::route('account-create-post') }}" method="post">
<div class="field">
Email<input type="text" name="email" {{ (Input::old('email')) ? 'value = "' .e(Input::old('email')). '" ':'' }}><br>
@if($errors->has('email'))
{{ $errors->first('email') }}
@endif
</div>
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
passowrd<input type="password" name="password_again"><br>
@if($errors->has('password_again'))
{{ $errors->first('password_again') }}
@endif
</div>
<input type="submit" value="submit">
{{ Form::token() }}
</form>

@stop