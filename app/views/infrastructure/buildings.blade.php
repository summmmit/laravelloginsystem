@extends('layout.main')

@section('content')


<ul>
            <table style="border: 1px;">
            <thead>
            <tr>
            <th>Building Name</th><th>Address</th><th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($buildings as $key)
            <tr>
            <td>{{ $key->building_name }}</td><td>{{ $key->address }}</td>
            <td>
            <form action="{{ URL::route('company-building-floor') }}" method="get">
                         {{ Form::token() }}
            <button type="submit" value="{{ $key->id }}" name="building">Edit</button>
            </form>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            <li>Add New Building</li>
            <li>
            <form action="{{ URL::Route('company-infrastructure-buildings-post') }}" method="post">
            Building Name<input type="text" name="building_name"><br>
            Address <input type="text" name="address"><br>
                         {{ Form::token() }}
            <button type="submit" name="company_id" value="{{ Auth::user()->id }}">Add</button>
            </form>
            </li>
</ul>
@stop