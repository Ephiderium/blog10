<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'body' => $this->body,
            'category' => $this->categories->first()->name,
            'author' => $this->user->name,
        ];
    }
}
