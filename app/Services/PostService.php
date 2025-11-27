<?php

namespace App\Services;

use App\Dto\PostDTO;
use App\Models\Category;
use App\Models\Post;
use App\Pipelines\Filters\CategoryFilter;
use App\Pipelines\Filters\SortFilter;
use App\Pipelines\Filters\WordFilter;
use App\Pipelines\PostPipeline;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostService
{
    public function __construct(private PostRepositoryInterface $model) {}

    public function all()
    {
        $pipeline = new PostPipeline([
            CategoryFilter::class,
            SortFilter::class,
            WordFilter::class,
        ]);
        $posts = $pipeline->apply($this->model->query())->get();

        return $posts;
    }

    public function find(int $id): Post
    {
        return $this->model->find($id);
    }

    public function create(PostDTO $dto): Post
    {
        $data = $dto->toArray();
        return $this->model->create($data);
    }

    public function update(int $id, PostDTO $dto): Post
    {
        $data = $dto->toArray();
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}
