<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $this->loginService->execute($request->get('email'), $request->get('password'));

            return response()->json(Auth::user()->createToken('auth_token')->plainTextToken);
        } catch (Exception $exception) {

            return response()->json([
                'error' => "The given password is incorrect.",
                'message' =>  $exception->getMessage(),
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
