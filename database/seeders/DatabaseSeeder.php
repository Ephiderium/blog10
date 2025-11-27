<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        User::factory()->count(5)
            ->has(Post::factory()->afterCreating(function ($post) {
                Like::factory()->count(3)->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'likeable_id' => $post->id,
                    'likeable_type' => Post::class,
                ]);
                Comment::factory()->count(3)
                ->hasAttached(Category::inRandomOrder()->first(), relationship: 'categories')
                ->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'commentable_type' => Post::class,
                    'commentable_id' => $post->id,
                ]);
                $post->categories()->attach(Category::inRandomOrder()->first());
            }))
            ->afterCreating(function ($user)
            {
                Like::factory()->count(3)->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'likeable_id' => $user->id,
                    'likeable_type' => User::class,
                ]);
                Comment::factory()->count(3)
                ->hasAttached(Category::inRandomOrder()->first(), relationship: 'categories')
                ->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'commentable_type' => User::class,
                    'commentable_id' => $user->id,
                ]);
            })
            ->create();
    }


}
