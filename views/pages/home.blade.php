@extends('layouts.main')

@section('content')
    <h1>Welcome, {{ $name }}!</h1>
    <ul>
        @foreach($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>



