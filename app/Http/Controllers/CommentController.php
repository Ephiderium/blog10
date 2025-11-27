<?php

namespace App\Http\Controllers;

use App\Dto\CommentDTO;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service) {}

    public function show(int $id): CommentResource|JsonResponse
    {
        try {
            $comment = Cache::remember("comments.{$id}", now()->addMinutes(3), function () use ($id) {
                return $this->service->find($id);
            });
            return CommentResource::make($comment);

        } catch (\Exception $e) {
            return response()->json(['message' => "Ошибка поиска комментария: " . $e->getMessage()], 500);
        }
    }

    public function store(StoreCommentRequest $request): CommentResource|JsonResponse
    {
        try {
            $dto = CommentDTO::fromRequest($request);
            $comment = $this->service->create($dto);
            return CommentResource::make($comment);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ошибка создания комментария: " . $e->getMessage()], 400);
        }
    }

    public function update(UpdateCommentRequest $request, int $id): CommentResource|JsonResponse
    {
        try {
            $dto = CommentDTO::fromRequest($request);
            $comment = $this->service->update($id, $dto);
            return CommentResource::make($comment);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ошибка обновления поста: " . $e->getMessage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(["message"=> "Ошибка удаления поста: ". $e->getMessage()],500);
        }
    }
}
