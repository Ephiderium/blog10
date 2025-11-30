<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct(protected DataService $service) {}

    public function getCategories(): JsonResponse
    {
        return response()->json(['categories' => $this->service->getCategories()]);
    }
}
