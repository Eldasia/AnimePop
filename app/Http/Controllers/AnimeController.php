<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Facades\Auth;

class AnimeController extends Controller
{
    public function list()
    {
        return view('animesList');
    }

    public function show(Anime $anime)
    {
        $is_in_list = 0;
        $is_viewed = 0;
        $user_id = null;

        if (Auth::user())
        {
            $user_id = Auth::user()->id;
        }

        if(Anime::find($anime->id)->users()->where('user_id', $user_id)->exists())
        {
            $is_in_list = 1;

            $anime_user = $anime->users()->where('user_id', $user_id)->first()->pivot->is_viewed;

            if($anime_user == 1)
            {
                $is_viewed = 1;
            }
        }

        return view('anime')->with([
            'anime' => $anime,
            'is_viewed' => $is_viewed,
            'is_in_list' => $is_in_list
        ]);
    }

    public function addToList(Request $request, Anime $anime)
    {
        $user_id = $request->user()->id;

        $anime->users()->toggle($user_id, ['is_viewed' => 0]);
        return back();
    }

    public function addToViewed(Anime $anime)
    {
        $user_id = Auth::user()->id;
        $anime_user = $anime->users()->where('user_id', $user_id)->first()->pivot->is_viewed;

        $anime->users()->updateExistingPivot($user_id, ['is_viewed' => !$anime_user]);
        return back();
    }

    public function addForm()
    {
        return view('addAnime');
    }
}
