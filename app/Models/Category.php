<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments(): MorphToMany
    {
        return $this->morphedByMany(Comment::class,"categoryable");
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class,"categoryable");
    }
}
