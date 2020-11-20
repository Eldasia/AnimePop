@extends('layout')

@section('content')
    <h2>Recherche pour {{ $term }}</h2>
    @if($posts->isNotEmpty())
        @foreach($posts as $post)
            <div class="card shadow mb-4">
                <div class="card-header text-white bg-dark  d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">{!! $post->highlight($post->title, $term) !!}</h6>
                    <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <div class="card-body">
                    <p><strong>{!! $post->highlight($post->intro, $term) !!}</strong></p>
                    <p>{!! $post->highlight($post->content, $term) !!}</p>
                </div>
                <div class="card-footer text-white bg-dark">
                    Ecrit par <a href="{{ route('profile', $post->user) }}">{{ $post->user->name }}</a>
                </div>
            </div>
        @endforeach
    @else
    <div class="alert alert-dark">Il n'y a aucun résultats</div>
    @endif
@endsection