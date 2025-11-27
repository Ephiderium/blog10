<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function query(): Builder;
    public function all(): Collection;
    public function find(int $id) : Post;
    public function create(array $data): Post;
    public function update(int $id, array $data): Post;
    public function delete(int $id): bool;
}
