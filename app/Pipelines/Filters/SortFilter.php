<?php

namespace App\Pipelines\Filters;

use App\Http\Requests\PostFilterRequest;
use App\Pipelines\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SortFilter implements FilterInterface
{
    public function __construct(protected PostFilterRequest $request) {}

    public function handle(Builder $query, Closure $next): Builder
    {
        switch ($this->request->input('sort')) {
            case 'oldest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'desc');
                break;
            case 'like':
                $query->withCount('likes')
                    ->orderByDesc('likes_count');
                break;
        }

        return $next($query);
    }
}
