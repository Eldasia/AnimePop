@extends('layout')

@section('content')

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">{{ config('app.name') }}</h1>
        </div>
    </div>

    <list-posts></list-posts> 
@endsection