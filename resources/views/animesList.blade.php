@extends('layout')

@section('content')
    @if($animes->isNotEmpty())

        @foreach($animes as $anime)
            <div class="d-flex m-4">
                <img src='{{ $anime->img_url }}' alt='Image générée par faker' height=100px width=100px class="pr-1"/>
                <div>
                    <h4><a href="{{ $anime->view_url }}">{{$anime->title}}</a></h4>
                    <p><span class="text-muted">{{ $anime->type }}</span><span class="badge badge-secondary m-2">{{$anime->episodes}}</span></p>
                    <p>{{Str::limit($anime->synopsis, 120)}}</p>
                </div>
            </div>
        @endforeach

    @else

    @endif
@endsection