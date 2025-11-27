<?php

namespace App\Repositories\Interfaces;

use App\Models\Like;

interface LikeRepositoryInterface
{
    public function create(array $data): Like;
    public function delete(int $id): bool;
}
