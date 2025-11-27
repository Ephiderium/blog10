<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Traits\AuthenticatesWithSanctumCookies;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PostTest extends TestCase
{
    use AuthenticatesWithSanctumCookies, RefreshDatabase;
    public function test_user_can_find_posts()
    {
        User::factory()->create([
            "name"=> "test",
            "email"=> "t@test.com",
            "password"=> Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            "email" => "t@test.com",
            "password" => "test00"
        ]);

        $this->seed(DatabaseSeeder::class);
        $response = $this->post('/api/posts');
        $response->assertOk();
    }

    public function test_user_can_find_post()
    {
        User::factory()->create([
            "name"=> "test",
            "email"=> "t@test.com",
            "password"=> Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            "email" => "t@test.com",
            "password" => "test00"
        ]);

        $this->seed(DatabaseSeeder::class);

        $post = Post::inRandomOrder()->first();
        $response = $this->get('/api/posts/' . $post->id);
        $response->assertOk();
    }

    public function test_user_can_create_post()
    {
        User::factory()->create([
            "name"=> "test",
            "email"=> "t@test.com",
            "password"=> Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            "email" => "t@test.com",
            "password" => "test00"
        ]);

        $this->seed(DatabaseSeeder::class);
        $response = $this->post("/api/store", [
            'title' => 'test',
            'content' => 'test',
            'category' => 'PHP',
        ]);
        $response->assertStatus(201);
    }

    public function test_user_can_update_post()
    {
        User::factory()->create([
            "name"=> "test",
            "email"=> "t@test.com",
            "password"=> Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            "email" => "t@test.com",
            "password" => "test00"
        ]);

        $this->seed(DatabaseSeeder::class);
        $this->post("/api/store", [
            'title' => 'crep',
            'content' => 'test',
            'category' => 'PHP',
        ]);

        $post = Post::where('title', 'crep')->first();
        $postId = $post->id;
        $response = $this->patch("/api/update/$postId", [
            'content' => 'creperum'
        ]);
        $response->assertStatus(200);
        $this->assertEquals('creperum', Post::where('content', 'creperum')->first()->content);
    }

    public function test_user_can_delete_post()
    {
        User::factory()->create([
            "name"=> "test",
            "email"=> "t@test.com",
            "password"=> Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            "email" => "t@test.com",
            "password" => "test00"
        ]);

        $this->seed(DatabaseSeeder::class);
        $this->post("/api/store", [
            'title' => 'test1',
            'content' => 'test',
            'category' => 'PHP',
        ]);

        $postId = Post::where('title', 'test1')->first()->id;
        $response = $this->delete("/api/destroy/$postId");
        $response->assertStatus(200);
    }
}
