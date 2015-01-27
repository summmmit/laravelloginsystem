@extends('layout.main')

@section('content')

<form action="{{ URL::route('company-building-floor-post') }}" method="post">
<div class="field">
Add Floor Number for this Building<input type="text" name="floor_number"><br>
@if($errors->has('floor_number'))
{{ $errors->first('floor_number') }}
@endif
</div>
<input type="hidden" name="building_id" value="{{ $building }}">
<input type="submit" value="submit">
{{ Form::token() }}
</form>

@stop