<?php

namespace App\Http\Controllers;

use App\Dto\PostDTO;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Nette\Utils\Json;

class PostController extends Controller
{
    public function __construct(protected PostService $service) {}

    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $posts = Cache::remember("posts.index", now()->addMinutes(3), function () {
                return $this->service->all();
            });

            return PostResource::collection($posts);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ошибка вывода постов: " . $e->getMessage()], 500);
        }
    }

    public function show(int $id): PostResource|JsonResponse
    {
        try {
            $post = Cache::remember("post.{$id}", now()->addMinutes(3), function () use ($id) {
                return $this->service->find($id);
            });
            return PostResource::make($post);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ошибка поиска поста: " . $e->getMessage()], 500);
        }
    }

    public function store(StorePostRequest $request): PostResource|JsonResponse
    {
        try {
            $dto = PostDTO::fromRequest($request);
            $post = $this->service->create($dto);

            return PostResource::make($post);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Ошибка создания поста: ' . $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdatePostRequest $request): PostResource|JsonResponse
    {
        try {
            $dto = PostDTO::fromRequest($request);
            $post = $this->service->update($id, $dto);

            return PostResource::make($post);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка обновления поста: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): bool|JsonResponse
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка удаления поста: ' . $e->getMessage()], 500);
        }
    }
}
