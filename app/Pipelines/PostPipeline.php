<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class PostPipeline
{
    protected array $filters = [];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function apply(Builder $query): Builder
    {
        return app(Pipeline::class)
            ->send($query)
            ->through($this->filters)
            ->thenReturn();
    }
}
