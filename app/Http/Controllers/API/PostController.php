<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function all()
    {
        return Post::with('user')->latest()->published()->get();
    }
}