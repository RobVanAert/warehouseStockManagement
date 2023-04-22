<?php

namespace Services;

use App\Services\LoginService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    private LoginService $loginService;

    public function setUp(): void
    {
        parent::setUp();
        $this->loginService = new LoginService();
    }

    public function testLoginSuccessFull()
    {
        $email = 'mail@test.com';
        $password = 'password';

        Auth::shouldReceive('attempt')
            ->once()
            ->with([
                'email' => $email,
                'password' => $password
            ])
            ->andReturn(true);

        $this->loginService->execute($email, $password);
    }

    public function testLoginFails()
    {
        $email = 'mail@test.com';
        $password = 'password';

        Auth::shouldReceive('attempt')
            ->once()
            ->with([
                'email' => $email,
                'password' => $password
            ])
            ->andReturn(false);
        $this->expectExceptionCode(Response::HTTP_UNAUTHORIZED);

        $this->loginService->execute($email, $password);
    }
}
