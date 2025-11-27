<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(protected Comment $model) {}

    public function find(int $id): Comment
    {
        return Comment::with('categories')->findOrFail($id);
    }

    public function create(array $data): Comment
    {
        if (isset($data["model_type"]) && \in_array($data["model_type"], ['post', 'user'])) {
            $model = $data["model_type"] === 'post' ? Post::class : User::class;
        } else {
            throw new \Exception('Не переданн тип модели');
        }

        $comment = Comment::create([
            'body' => $data['body'],
            'user_id' => Auth::id(),
            'commentable_id' => $data['model_id'],
            'commentable_type' => $model,
        ]);

        $categoryId = Category::where('name', $data['category'])
        ->first()->id;
        $comment->categories()->attach($categoryId);

        return $comment;
    }

    public function update(int $id, array $data): Comment
    {
        $comment = $this->model->findOrFail($id);
        $comment->update($data);
        return $this->model->with('categories')->findOrFail($id);
    }

    public function delete(int $id): bool
    {
        $comment = $this->model->findOrFail($id);
        return $comment->delete();
    }
}
