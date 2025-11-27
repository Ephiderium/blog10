<?php

namespace App\Dto;

class LikeDTO
{
    public function __construct(
        public ?int $likeable_id,
        public ?string $likeable_type,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            likeable_id: $request->input("likeable_id"),
            likeable_type: $request->input("likeable_type"),
        );
    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this), function ($value) {
            return $value !== null;
        });
    }
}
