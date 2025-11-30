<?php

namespace App\Services;

use App\Repositories\DataRepository;
use Illuminate\Support\Collection;

class DataService
{
    public function __construct(protected DataRepository $model) {}

    public function getCategories(): Collection
    {
        return $this->model->getCategories()->pluck('name');
    }
}
