@extends('layout')

@section('content')
    <div class="card shadow mb-4">

        <div class="card-header text-white bg-dark  d-flex justify-content-between align-items-center">
            <h6 class="mb-0">{{ $anime->title }}</h6>
            <span>{{ $anime->type }}</span>
        </div>

        <div class="card-body">
            <img src="{{ $anime->img_url}}" class="rounded float-left mr-2" alt="Image du anime {{ $anime->title }}" width=200px height=300px >
            <div style="height: 300px">
                <p><strong>{{ $anime->synopsis }}</strong></p>
                <p>Nombres d'épisodes: {{ $anime->episodes }}</p>
                <p>Début de diffusion: {{ $anime->start_diff }}</p>
                <p>Fin de diffusion: {{ $anime->end_diff }}</p>
                <p>Classé: {{ $anime->rated }}</p>
                <p><a href="{{ $anime->mal_url}}">Voir l'animé sur My Anime List</a></p>
            </div>

            @guest
            <p class="bg-warning text-center m-4 p-2">
                <a href="/login">Connectez-vous</a> pour réagir!
            </p>
            @else
            <div>
                <div>
                    @if ($is_in_list == 1)
                        <a type="button" href="{{ route('addToList', $anime) }}" class="btn btn-lg btn-outline-secondary m-2 border rounded-pill shadow"><i class="fas fa-check m-1"></i>Animé ajouté à la liste</a>
                    @else
                        <a type="button" href="{{ route('addToList', $anime) }}" class="btn btn-lg btn-outline-dark m-2 border rounded-pill shadow"><i class="far fa-list-alt m-1"></i>Ajouter à la liste</a>
                    @endif
                </div>
                <div>
                    @if ($is_viewed == 1)
                        <a type="button" href="{{ route('addToViewed', $anime) }}" class="btn btn-lg btn-outline-secondary m-2 border rounded-pill shadow"><i class="far fa-check-square m-1"></i>Animé vu</a>
                    @elseif ($is_in_list == 1)
                        <a type="button" href="{{ route('addToViewed', $anime) }}" class="btn btn-lg btn-outline-dark m-2 border rounded-pill shadow"><i class="far fa-square m-1"></i>Animé vu</a>
                    @endif
                </div>
            </div>
            @endguest

        </div>

    </div>
@endsection