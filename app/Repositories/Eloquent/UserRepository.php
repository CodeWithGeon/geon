<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * findByEmail
     *
     * @param  mixed $email
     * @return User
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
    public function getByRole(string $role)
    {
        return $this->model->where('role', $role)->get();
    }

    /**
     * create
     *
     * @param  mixed $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->create($data);
    }
}
