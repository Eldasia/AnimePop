@extends('layout')

@section('content')

<div class="mb-5">
    <div class="display-3">{{ $user->name }}</div>
</div>

<div class="d-flex justify-content-between">
    <div style="width: 49%;">
        <h2>Billets</h2>
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="card shadow mb-4">
                    <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">{{ $post->title }}</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ $post->intro }}</strong></p>
                        <p>{{ $post->content }}</p>
                    </div>
                    <div class="card-footer text-white bg-dark d-flex justify-content-between">
                        <span class="text-muted mt-1">{{ $post->created_at->diffForHumans() }}</span>
                        <a class="btn btn-secondary" href="{{ $post->view_url }}" role="button">Voir le post &raquo;</a>
                    </div>
                </div>
            @endforeach
        @else
        <p class="alert alert-danger">Aucun billets</p>
        @endif
    </div>

    <div style="width: 49%;">
        <h2>Commentaires</h2>
        @if ($comments->isNotEmpty())
            @foreach ($comments as $comment)
                <div class="card shadow mb-4">
                    <div class="card-header text-white bg-secondary  d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">{{ $comment->post->title }}</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $comment->message }}</p>
                    </div>
                    <div class="card-footer text-white bg-secondary d-flex justify-content-between">
                        <span class="mt-1">{{ $comment->created_at->diffForHumans() }}</span>
                        <a class="btn btn-dark" href="{{ $comment->post->view_url }}" role="button">Voir le post &raquo;</a>
                    </div>
                </div>
            @endforeach
        @else
        <p class="alert alert-danger">Aucun commentaires</p>
        @endif
    </div>
</div>


@endsection