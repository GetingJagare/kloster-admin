@extends('layouts.basic')

@section('title')
    Login
@endsection

@section('content')
    <div id="app"></div>
@endsection

@section('scripts')
    @vite(['resources/js/login.js'])
@endsection
