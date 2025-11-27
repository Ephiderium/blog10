<?php

namespace App\Dto;

final readonly class UserDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $password,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this), function ($value) {
            return $value !== null;
        });
    }
}
