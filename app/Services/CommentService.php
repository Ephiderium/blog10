<?php

namespace App\Services;

use App\Dto\CommentDTO;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService
{
    public function __construct(private CommentRepositoryInterface $model) {}

    public function find(int $id): Comment
    {
        return $this->model->find($id);
    }

    public function create(CommentDTO $dto): Comment
    {
        $data = $dto->toArray();
        return $this->model->create($data);
    }

    public function update(int $id, CommentDTO $dto): Comment
    {
        $data = $dto->toArray();
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}
