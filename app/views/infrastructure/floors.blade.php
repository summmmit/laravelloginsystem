@extends('layout.main')
<?php

echo "<pre>";
print_r($building);

?>
@section('content')
<ul>
            <table style="border: 1px;">
            <thead>
            <tr>
            <th>Floor Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($floors as $key)
            <tr>
            <td>{{ $key->floor_number }}</td>
            <td>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            <li>
            <form action="{{ URL::Route('company-building-floor-create') }}" method="get">
                         {{ Form::token() }}
            <button type="submit" name="building" value="{{ $building }}">Add New Floor</button>
            </form>
            </li>
</ul>
@stop