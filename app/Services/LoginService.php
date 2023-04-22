<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * @throws Exception
     */
    public function execute(string $email, string $password): void
    {
        $authenticated = Auth::attempt(['email' => $email, 'password' => $password]);
        if (!$authenticated) {
            throw new Exception('Invalid credentials', Response::HTTP_UNAUTHORIZED);
        }
    }
}
