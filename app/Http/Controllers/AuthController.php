<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    /**
     * register
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = $this->authService->register($data);
        return response()
            ->json([
                'user' => $user
            ]);
    }
    /**
     * login
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $token = $this->authService->login($credentials);
            return response()->json(['token' => $token]);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
    /**
     * logout
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($user && is_object($user)) {
            $this->authService->logout($user);
            return response()->json(['message' => 'Logged out successfully']);
        }
        return response()->json(['message' => 'No authenticated user'], 401);
    }
}
