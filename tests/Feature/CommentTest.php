<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Traits\AuthenticatesWithSanctumCookies;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use AuthenticatesWithSanctumCookies, RefreshDatabase;

    public function test_user_can_show_comment()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password' => 'test00',
        ]);

        $this->seed(DatabaseSeeder::class);
        $commentId = Comment::first()->id;

        $response = $this->get('/api/comment/' . $commentId);
        $response->assertStatus(200);
    }

    public function test_user_can_store_comment()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password' => 'test00',
        ]);

        $this->seed(DatabaseSeeder::class);
        $response = $this->post('/api/comments', [
            'body' => 'test',
            'category' => 'PHP',
            'model_id' => User::inRandomOrder()->first()->id,
            'model_type' => 'user',
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_update_comment()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::factory()
        ->has(Comment::factory())
        ->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password' => 'test00',
        ]);

        $commentID = Comment::first()->id;
        $response = $this->patch('/api/comments/'. $commentID, ['body' => 'update']);
        $response->assertStatus(200);
    }

    public function test_user_can_destroy_comment()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::factory()
        ->has(Comment::factory())
        ->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password' => 'test00',
        ]);

        $commentID = Comment::first()->id;
        $response = $this->delete('/api/comments/'. $commentID);
        $response->assertStatus(200);
    }
}
