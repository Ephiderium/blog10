<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $this->get('/sanctum/csrf-cookie');

        $response = $this->post('/api/register', [
            'name' => 'test',
            'email' => 't@test.com',
            'password' => 'test00',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 't@test.com',
        ]);

        $this->get('/api/user/email/t@test.com')
            ->assertStatus(200);
    }

    public function test_user_can_login()
    {
        $this->post('/api/register', [
            'name' => 'test',
            'email' => 't@test.com',
            'password' => 'test00',
        ]);

        $response = $this->post('/api/login', [
            'email' => 't@test.com',
            'password' => 'test00',
        ]);

        $response->assertStatus(200);
        $response = $this->get('/api/users/email/t@test.com')->assertOk();
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 't@test.com',
            'password' => Hash::make('test00'),
        ]);

        $this->get('/sanctum/csrf-cookie');

        $this->post('/api/login', [
            'email' => 't@test.com',
            'password' => 'test00',
        ]);
        $response = $this->get('/api/users/email/t@test.com');
        $response->assertOk();

        $response = $this->post('/api/logout');
        $response->assertStatus(200);
    }
}
