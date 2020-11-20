<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Anime;
use Illuminate\Support\Str;

class AnimeController extends ApiController 
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api')->only('store');
    }

    public function search(Request $request)
    {
        $validated = $this->validate($request, [
            'query' => [
                'required',
                'min:3',
                'max:40'
            ]
        ]);

        $url = sprintf('https://api.jikan.moe/v3/search/anime?q=%s&type=tv&limit=5', urlencode($validated['query']));

        $animes = Cache::remember($validated['query'], Carbon::now()->addMinutes(5), function() use($url) {
            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful())
            {
                return $response->json()['results'];
            } 

            return false;
        });

        return response()->json($animes);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'mal_id' => [
                'required',
                'numeric',
                'min:1',
                'max:999999',
                'unique:animes,mal_id'
            ]
        ]);

        $url = sprintf('https://api.jikan.moe/v3/anime/%d', $validated['mal_id']);

        $anime = Cache::remember($url, Carbon::now()->addMinutes(5), function() use($url) {
            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful())
            {
                return $response->json();
            } 

            return false;
        });

        if ($anime === false)
        {
            return response()->json([
                'message' => 'Impossible de récupérer l\'animé'
            ], 422);
        }

        $model = new Anime;

        $model->fill([
            'mal_id' => $anime['mal_id'],
            'title' => $anime['title'],
            'slug' => Str::slug($anime['title']),
            'mal_url' => $anime['url'],
            'img_url' => $anime['image_url'],
            'type' => $anime['type'],
            'synopsis' => $anime['synopsis'],
            'episodes' => $anime['episodes'],
            'start_diff' => $anime['aired']['from'],
            'end_diff' => $anime['aired']['to'],
            'rated' => $anime['rating']
        ])->save();

        return response()->json($model);
    }
}