<?php

namespace App\Http\Controllers;

use App\Dto\UserDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service) {}

    public function register(RegisterRequest $request): UserResource|JsonResponse
    {
        try {
            $dto = UserDTO::fromRequest($request);
            $user = $this->service->register($dto, $request);

            return UserResource::make($user);
        } catch (\Exception $e) {
            return response()->json(['message' => "Ошибка регистрации: " . $e->getMessage()], 400);
        }
    }

    public function login(LoginRequest $request): UserResource|JsonResponse
    {
        try {
            $dto = UserDTO::fromRequest($request);
            $user = $this->service->login($dto, $request);

            return UserResource::make($user);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ошибка логина" . $e->getMessage(), 400]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->service->logout($request);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ошибка выхода" . $e->getMessage(), 500]);
        }
    }
}
