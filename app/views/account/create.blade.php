@extends('layout.main')

@section('content')

<form action="{{ URL::route('account-create-post') }}" method="post">
<div class="field">
Company Name<input type="text" name="company_name" {{ (Input::old('company_name')) ? 'value = "' .e(Input::old('company_name')). '" ':'' }}><br>
@if($errors->has('company_name'))
{{ $errors->first('company_name') }}
@endif
</div>
<div class="field">
Address<input type="text" name="address" {{ (Input::old('address')) ? 'value = "' .e(Input::old('address')). '" ':'' }}><br>
@if($errors->has('address'))
{{ $errors->first('address') }}
@endif
</div>
<div class="field">
Country<input type="text" name="country" {{ (Input::old('country')) ? 'value = "' .e(Input::old('country')). '" ':'' }}><br>
@if($errors->has('country'))
{{ $errors->first('country') }}
@endif
</div>
<div class="field">
State<input type="text" name="state" {{ (Input::old('state')) ? 'value = "' .e(Input::old('state')). '" ':'' }}><br>
@if($errors->has('state'))
{{ $errors->first('state') }}
@endif
</div>
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