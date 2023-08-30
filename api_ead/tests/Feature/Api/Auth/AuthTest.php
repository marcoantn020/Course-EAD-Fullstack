<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Tests\Feature\Traits\TokenTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use TokenTrait;
    public function test_fail_auth()
    {
        $response = $this->postJson('/auth', []);

        $response->assertUnprocessable();
    }

    public function test_success_auth()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => '12345678',
            'device_name' => 'test'
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'token'
        ]);
    }

    public function test_logout_user_auth_fail()
    {
        $logout = $this->getJson('/logout', headers: []);

        $logout->assertUnauthorized();
        $logout->assertJsonStructure([
            'message'
        ]);
    }

    public function test_logout_user_auth_success()
    {
        $token = $this->getToken();
        $logout = $this->getJson('/logout', headers: $this->defaultHeader());

        $logout->assertOk();
        $logout->assertJsonStructure([
            'message'
        ]);
    }

    public function test_get_user_auth_fail()
    {
        $response = $this->getJson('/me', headers: []);
        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_get_user_auth_success()
    {
        $response = $this->getJson('/me', headers: $this->defaultHeader());
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
            ]
        ]);
    }
}
