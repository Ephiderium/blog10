<?php

namespace Tests\Feature;

use App\Models\User;
use App\Traits\AuthenticatesWithSanctumCookies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use AuthenticatesWithSanctumCookies, RefreshDatabase;

    public function test_user_can_show()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password'=> 'test00',
        ]);

        $response = $this->get('/api/users/id/' . $user->id);
        $response->assertStatus(200);
    }

    public function test_user_can_showByEmail()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password'=> 'test00',
        ]);

        $response = $this->get('/api/users/email/' . $user->email);
        $response->assertStatus(200);
    }

    public function test_user_can_update()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password'=> 'test00',
        ]);

        $response = $this->patch('/api/users/' . $user->id);
        $response->assertStatus(200);
    }

    public function test_user_can_destroy()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->actingAsCookie([
            'email' => $user->email,
            'password'=> 'test00',
        ]);

        $user2 = User::factory()->create();

        $response = $this->delete('/api/users/'. $user2->id);
        $response->assertStatus(200);
    }
}
