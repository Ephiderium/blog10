<?php

namespace App\Pipelines;

use App\Http\Requests\PostFilterRequest;
use Closure;
use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function handle(Builder $query, Closure $next): Builder;
}
