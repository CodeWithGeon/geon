<?php

namespace App\Services\Auth;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

class AuthService
{
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::query()->create($data);
    }


    /**
     * login
     *
     * @param  mixed $data
     * @return string
     */
    public function login(array $data): string
    {
        $user = User::query()->where('email', $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        return $user->createToken('auth-token')->plainTextToken;
    }

    /**
     * logout
     *
     * @param  mixed $user
     * @return void
     */
    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
