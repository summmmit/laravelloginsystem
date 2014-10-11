@extends('layout.main')

@section('content')

<form action="{{ URL::route('account-change-password-post') }}" method="post">
<div class="field">
Old Password<input type="password" name="old_password"><br>
@if($errors->has('old_password'))
{{ $errors->first('old_password') }}
@endif
</div>
<div class="field">
New Password<input type="password" name="new_password"><br>
@if($errors->has('new_password'))
{{ $errors->first('new_password') }}
@endif
</div>
<div class="field">
Confirm New Password<input type="password" name="Confirm_new_password"><br>
@if($errors->has('Confirm_new_password'))
{{ $errors->first('Confirm_new_password') }}
@endif
</div>
<input type="submit" value="submit">
{{ Form::token() }}
</form>

@stop