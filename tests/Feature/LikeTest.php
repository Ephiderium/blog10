<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Traits\AuthenticatesWithSanctumCookies;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use AuthenticatesWithSanctumCookies, RefreshDatabase;

    public function test_user_can_create_like()
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

        $response = $this->post('/api/likes', [
            'likeable_id' => $user->id,
            'likeable_type' => 'user',
        ]);
        $response->assertStatus(201);
    }

    public function test_user_can_delete_like()
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

        $likeId = Like::first()->id;
        $response = $this->delete('/api/likes/' . $likeId);
        $response->assertStatus(200);
    }
}
