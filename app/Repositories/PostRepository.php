<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(protected Post $model) {}

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function all(): Collection
    {
        return $this->model->with(['likes', 'categories'])->all();
    }

    public function find(int $id): Post
    {
        return $this->model->with(['likes', 'categories'])->find($id);
    }

    public function create(array $data): Post
    {
        $post = $this->model->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id()
        ]);
        $categoryId = Category::where('name', $data['category'])->first()->id;
        $post->categories()->attach($categoryId);

        return $post;
    }

    public function update(int $id, array $data): Post
    {
        $post = $this->model->find($id);
        $post->update($data);

        return $this->model->with(['likes', 'categories'])->find($id);
    }

    public function delete(int $id): bool
    {
        $post = $this->model->find($id);
        return $post->delete();
    }
}
