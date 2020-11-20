<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\AnimeController;

Auth::routes();

Route::get('/', [PostController::class, 'home'])->name('home');
Route::get('/home', [PostController::class, 'home']);

Route::get('post/{post:slug}', [PostController::class,'show'])->name('post');

Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile');

Route::get('animes', [AnimeController::class, 'list'])->name('animesList');
Route::get('animes/anime/{anime:slug}', [AnimeController::class, 'show'])->name('anime');
Route::get('animes/add', [AnimeController::class, 'addForm'])->name('addAnimeForm');
Route::get('animes/add-to-list/{anime:slug}', [AnimeController::class ,'addToList'])->name('addToList');
Route::get('animes/add-to-viewed/{anime:slug}', [AnimeController::class, 'addToViewed'])->name('addToViewed');