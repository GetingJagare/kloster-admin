@extends('layouts.basic')

@section('title')
    Admin Panel
@endsection

@section('content')
    <div id="app"></div>
@endsection

@section('scripts')
    @vite(['resources/js/admin.js'])
@endsection
