<?php

namespace App\Dto;

final readonly class PostDTO
{
    public function __construct(
        public ?string $title,
        public ?string $content,
        public ?string $category,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            title: $request->input('title'),
            content: $request->input('content'),
            category: $request->input('category'),
        );
    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this), function ($value) {
            return $value !== null;
        });
    }
}
