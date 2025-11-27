<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'posts' => $this->when(request()->routeIs(['users.show', 'users.index']),
                PostResource::collection($this->whenLoaded('posts'))),
            'posts_count' => $this->whenCounted('posts'),
            'likes' => $this->whenCounted('likes'),
            'comments' => $this->whenLoaded('comments'),
            'comments_count' => $this->whenCounted('comments'),
        ];
    }
}
