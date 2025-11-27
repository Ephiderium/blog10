<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LikeRepository implements LikeRepositoryInterface
{
    public function __construct(private Like $model) {}
    public function create(array $data): Like
    {
        $model = $data["likeable_type"] == 'post' ? Post::class : User::class;
        return $this->model->create([
            'user_id' => Auth::id(),
            'likeable_id' => $data['likeable_id'],
            'likeable_type' => $model,
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }
}
