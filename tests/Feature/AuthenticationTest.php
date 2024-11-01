<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test  */
    public function a_user_can_register(): void
    {
        $response = $this->postJson('/api/v1/register', [
            'username' => 'mmdreza',
            'email' => 'mmdreza@gmail.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);
    }

    /** @test  */
    public function a_user_can_login(): void
    {
        $user = User::factory()->create([
            'username' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => '12345678',

        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'user1@gmail.com',
            'password' => '12345678',
        ]);
    }
}
