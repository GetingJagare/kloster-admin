@extends('layouts.basic')

@section('title')
    Products
@endsection

@section('content')
    <div id="app"></div>
@endsection

@section('scripts')
    @vite(['resources/js/app.js'])
@endsection
