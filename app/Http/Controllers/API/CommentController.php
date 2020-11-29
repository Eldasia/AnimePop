<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;
use App\Models\Anime;
use App\Models\Comment;
use App\Http\Controllers\API\ApiController;
use App\Http\Resources\CommentResource;
use App\Models\Product;
use App\Notifications\NotifyPostAuthorOnNewComment;

class CommentController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api')->except('show');
    }
    
    public function show($type, $id)
    {
        
        switch($type)
        {
            case 'anime':
                $model = Anime::with('comments.user')->findOrFail($id);
            break;

            case 'post':
                $model = Post::with('comments.user')->findOrFail($id);
            break;

            case 'product':
                $model = Product::with('comments.user')->findOrFail($id);
            break;

            default:
                abort(404);
            break;
        }

        return CommentResource::collection($model->comments);
    }

    public function add(Request $request, Post $post)
    {
        $validated = $this->validate($request, [
            'message' => [
                'required',
                'min:6',
                'max:3000',
            ]
        ]);

        $comment = Comment::create([
            'message' => $validated['message'],
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
        ]);

        // if ($post->user_id != $comment->user_id) {
        //     $post->user->notify(new NotifyPostAuthorOnNewComment($post, $comment));
        // }
        
        return $comment;
    }

    public function delete(Request $request, Post $post, Comment $comment)
    {
        abort_if($post->id != $comment->post_id, 403, "Le commentaire n'appartient pas au billet");
        abort_if($post->user_id != $request->user()->id, 403, "Seul l'auteur du billet peut supprimer les commentaires");
        
        $comment->delete();

        return response()->noContent();
    }
}
