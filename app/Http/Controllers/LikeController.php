<?php

namespace App\Http\Controllers;

use App\Dto\LikeDTO;
use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(protected LikeService $service) {}

    public function store(LikeRequest $request): Like|JsonResponse
    {
        try {
            $dto = LikeDTO::fromRequest($request);
            return response()->json(['data' => $this->service->create($dto)]);
        } catch (\Exception $e) {
            return response()->json(['message' => "Ошибка создания лайка" . $e->getMessage()],500);
        }
    }

    public function destroy(int $id): bool|JsonResponse
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(["message"=> "Ошибка удаления поста" . $e->getMessage()], 500);
        }
    }
}
