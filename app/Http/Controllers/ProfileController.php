<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function show(User $user)
    {
        return view('profile')->with([
            'user' => $user,
            'posts' => $user->publishedPosts,
            'comments' => $user->load('comments.post')->comments
        ]);
    }
}
