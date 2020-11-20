@extends('layout')

@section('content')
    <post :post='{{ $post }}'></post>

    <comments-post :id="{{ $post->id }}" :author="{{ $post->user }}"></comments-post>
@endsection