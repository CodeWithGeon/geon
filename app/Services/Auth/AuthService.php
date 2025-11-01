<?php

namespace App\Services\Auth;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

class AuthService
{
    protected UserRepositoryInterface $userRepository;
    /**
     * __construct
     *
     * @param  mixed $userRepository
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * register
     *
     * @param  mixed $data
     * @return User
     */
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['api_token'] = Str::random(60);
        $data['is_admin'] = $data['is_admin'] ?? false;

        return $this->userRepository->create($data);
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
