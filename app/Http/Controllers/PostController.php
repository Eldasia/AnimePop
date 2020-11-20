<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function show(Post $post)
    {
        return view('post')->with([
            'post' => $post->loadMissing('user'),
        ]);
    }
}
