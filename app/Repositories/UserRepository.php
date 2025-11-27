<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $model) {}

    public function findByEmail(string $email): User
    {
        return $this->model->where('email', $email)->first();
    }

    public function find(int $id): User
    {
        return $this->model->find($id);
    }

    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = $this->model->find($id);
        $user->update($data);

        return $this->model->find($id);
    }

    public function delete(int $id): bool
    {
        $user = $this->model->find($id);
        return $user->delete();
    }
}
