@extends('layout.main')

@section('content')
<p>Name : {{ Auth::user()->username }}</p>
<p>Email Id : {{ Auth::user()->email }}</p>
@stop