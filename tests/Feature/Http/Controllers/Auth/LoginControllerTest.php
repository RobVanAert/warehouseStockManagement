<?php

namespace Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use refreshDatabase;

    public function testLoginFailsWithoutEmail()
    {
        $response = $this->postJson('/api/login', [
            'password' => 'password',
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('The email field is required.', $response->getContent());
    }

    public function testLoginFailsWithoutValidEmail()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'invalid-email',
            'password' => 'password',
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('The email field must be a valid email address.', $response->getContent());
    }

    public function testLoginFailsWithoutExistingEmail()
    {
        $email = 'mail@test.com';
        $response = $this->postJson('/api/login', [
            'email' => $email,
            'password' => 'password',
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('The selected email is invalid.', $response->getContent());
    }

    public function testLoginFailsWithoutPassword()
    {
        $email = 'mail@test.com';
        User::factory()->create([
            'email' => $email,
        ]);
        $response = $this->postJson('/api/login', [
            'email' => $email,
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('The password field is required.', $response->getContent());
    }

    public function testLoginsTheUser()
    {
        $email = 'mail@test.com';
        User::factory()->create([
            'email' => $email,
        ]);
        $this->postJson('/api/login', [
            'email' => $email,
            'password' => 'password'
        ])->assertStatus(Response::HTTP_OK);

        $this->assertAuthenticated();
    }

    public function testDoesNotLoginTheUserWithWrongPassword()
    {
        $email = 'mail@test.com';
        User::factory()->create([
            'email' => $email,
        ]);
        $this->postJson('/api/login', [
            'email' => $email,
            'password' => 'wrongPassword'
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertGuest();
    }
}
