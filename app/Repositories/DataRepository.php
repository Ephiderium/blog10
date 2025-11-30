<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\DataRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DataRepository implements DataRepositoryInterface
{
    public function getCategories(): Collection
    {
        return Category::all();
    }
}
