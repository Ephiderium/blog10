<?php

namespace App\Http\Controllers;

use App\Dto\UserDTO;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function show(int $id): JsonResponse|UserResource
    {
        try {
            $user = Cache::remember("user.{$id}", now()->addMinutes(3), function () use ($id) {
                return $this->service->find($id);
            });

            return UserResource::make($user);
        } catch (\Exception $e) {
            return response()->json(['massage' => 'Ошибка отображения пользователя: ' . $e->getMessage()], 500);
        }
    }

    public function showByEmail(string $email): JsonResponse|UserResource
    {
        try {
            $user = Cache::remember("user.{$email}", now()->addMinutes(3), function () use ($email) {
                return $this->service->findByEmail($email);
            });

            return UserResource::make($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка поиска пользователя по email: ' . $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdatePostRequest $request): JsonResponse|UserResource
    {
        try {
            $dto = UserDTO::fromRequest($request);
            $user = $this->service->update($id, $dto);
            return UserResource::make($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка обновления пользователя: ' . $e->getMessage()], 400);
        }
    }

    public function destroy(int $id): JsonResponse|bool
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(['message'=> 'Ошибка удаления пользователя: '. $e->getMessage()], 500);
        }
    }
}
