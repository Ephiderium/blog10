<?php

namespace App\Pipelines\Filters;

use App\Http\Requests\PostFilterRequest;
use App\Pipelines\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class WordFilter implements FilterInterface
{
    public function __construct(protected PostFilterRequest $request) {}
    public function handle(Builder $query, Closure $next): Builder
    {
        if ($this->request->filled('word')) {
            $word = $this->request->input('word');

            $query->where(function($q) use ($word) {
                $q->where('title', 'like', "%{$word}%")
                ->orWhere('content', 'like', "%{$word}%");
            });
        }

        return $next($query);
    }
}
