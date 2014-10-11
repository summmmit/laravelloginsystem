@extends('layout.main')

@section('content')

<form action="{{ URL::route('account-forgot-password') }}" method="post">
<div class="field">
Your Email Address : <input type="email" name="email"{{ (Input::old('email')) ? 'value = "' .e(Input::old('email')). '" ':'' }}>
<input type="submit" value="submit"><br>
@if($errors->has('email'))
{{ $errors->first('email') }}
@endif
</div>
{{ Form::token() }}
</form>

@stop