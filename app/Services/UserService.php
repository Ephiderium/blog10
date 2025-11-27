<?php

namespace App\Services;

use App\Dto\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(private UserRepositoryInterface $model) {}

    public function findByEmail(string $email): User
    {
        return $this->model->findByEmail($email);
    }

    public function find(int $id): User
    {
        return $this->model->find($id);
    }

    public function create(UserDTO $dto): User
    {
        $data = $dto->toArray();
        return $this->model->create($data);
    }

    public function update(int $id, UserDTO $dto): User
    {
        $data = $dto->toArray();
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}
