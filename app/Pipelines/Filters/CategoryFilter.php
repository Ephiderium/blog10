<?php

namespace App\Pipelines\Filters;

use App\Http\Requests\PostFilterRequest;
use App\Pipelines\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements FilterInterface
{
    public function __construct(protected PostFilterRequest $request) {}

    public function handle(Builder $query, Closure $next): Builder
    {
        if ($this->request->filled('category')) {
            $query->whereHas('categories', function ($q) {
                $q->where('name', $this->request->input('category'));
            });
        }

        return $next($query);
    }
}
