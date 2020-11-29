<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'intro' => $this->intro,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'created_at_for_human' => $this->created_at_for_human,
            'view_url' => $this->view_url,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
