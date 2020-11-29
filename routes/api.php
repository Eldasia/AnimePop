<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\AnimeController;
use App\Http\Controllers\API\PostController;

Route::get('/search', function (Request $request) {
    $term = $request->input('search');
    $posts = Post::where(function($query) use($term){
        $query->where('title', 'like', '%' . $term . '%')
              ->orWhere('intro', 'like', '%' . $term . '%')
              ->orWhere('content', 'like', '%' . $term . '%');
    })->published()->take(10)->latest()->get();
    return $posts;
});

Route::get('/posts', [PostController::class, 'all']);

Route::get('/comments/{type}/{id}', [CommentController::class, 'show']);
// Route::delete('/comment/{commentable:id}/{comment:id}', [CommentController::class, 'delete']);
// Route::post('/comment/{commentable:id}', [CommentController::class, 'add']);

Route::get('/animes', [AnimeController::class, 'list']);
Route::post('/animes/store', [AnimeController::class, 'store']);
Route::post('/animes/search', [AnimeController::class, 'search']);