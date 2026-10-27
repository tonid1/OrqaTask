@extends('layouts.app')

@section('content')

@auth
    @include('partials.files')
@else
    @include('partials.login')
@endauth

@endsection