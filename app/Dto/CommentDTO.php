<?php

namespace App\Dto;

final readonly class CommentDTO
{
    public function __construct(
        public string $body,
        public ?string $category,
        public ?int $model_id,
        public ?string $model_type,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            body: $request->input("body"),
            category: $request->input("category"),
            model_id: $request->input("model_id"),
            model_type: $request->input("model_type"),
        );
    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this), function ($value) {
            return $value !== null;
        });
    }
}
