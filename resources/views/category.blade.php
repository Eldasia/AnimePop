@extends('layout')

@section('content')

<div class="container mb-5">
    <blockquote class="display-3">{{ $category->title }}</blockquote>
    <footer class="blockquote-footer" style='font-size: 20px'>{{ $category->description }}</footer>
</div>

@if($posts->isNotEmpty())
    @foreach($posts as $post)
        <div class="card shadow mb-4">
            <div class="card-header text-white bg-dark  d-flex justify-content-between align-items-center">
                <h6 class="mb-0">{{ $post->title }}</h6>
            </div>
            <div class="card-body">
                <p><strong>{{ $post->content }}</strong></p>
            </div>
            <div class="card-footer text-white bg-dark">
                Ecrit par <a href="#">{{ $post->user->name }}</a>
            </div>
        </div>
    @endforeach
@endif

@endsection