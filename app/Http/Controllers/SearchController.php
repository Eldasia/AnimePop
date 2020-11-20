<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $term = $request->input('search');
        $posts = Post::where(function(Builder $query) use($term){
            $query->where('title', 'like', '%' . $term . '%')
                  ->orWhere('intro', 'like', '%' . $term . '%')
                  ->orWhere('content', 'like', '%' . $term . '%');
        })->published()->take(10)->latest()->get();

        return view('result')->with([
            'posts' => $posts,
            'term' => $term,
        ]);
    }
}
