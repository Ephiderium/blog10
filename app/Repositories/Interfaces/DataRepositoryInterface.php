<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface DataRepositoryInterface
{
    public function getCategories(): Collection;
}
