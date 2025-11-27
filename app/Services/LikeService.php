<?php

namespace App\Services;

use App\Dto\LikeDTO;
use App\Models\Like;
use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeService
{
    public function __construct(private LikeRepositoryInterface $model) {}

    public function create(LikeDTO $dto): Like
    {
        $data = $dto->toArray();
        return $this->model->create($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}
