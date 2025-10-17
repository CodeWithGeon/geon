<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function findByEmail(string $email);
    public function getByRole(string $role);
    public function create(array $data): User;
}
