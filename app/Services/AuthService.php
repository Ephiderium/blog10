<?php

namespace App\Services;

use App\Dto\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(protected UserRepositoryInterface $model) {}
    public function login(UserDTO $dto, Request $request): User
    {
        $credentials = $dto->toArray();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        return $this->model->findByEmail($credentials["email"]);
    }

    public function register(UserDTO $dto, Request $request): User
    {
        $data = $dto->toArray();
        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $user;
    }

    public function logout(Request $request): void
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
