<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $guarded = [];

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class,"categoryable");
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class,"likeable");
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class,"commentable");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
