@extends('layout.main')

@section('content')

<form action="{{ URL::route('company-infrastructure-buildings-post') }}" method="post">
<div class="field">
Building Name<input type="text" name="building_name"><br>
@if($errors->has('building_name'))
{{ $errors->first('building_name') }}
@endif
</div>
<div class="field">
Address<input type="text" name="address"><br>
@if($errors->has('address'))
{{ $errors->first('address') }}
@endif
</div>
<div class="field">
Number of Floors Occupied<input type="text" name="number_of_floors"><br>
@if($errors->has('number_of_floors'))
{{ $errors->first('number_of_floors') }}
@endif
</div>
<input type="submit" value="submit">
{{ Form::token() }}
</form>

@stop