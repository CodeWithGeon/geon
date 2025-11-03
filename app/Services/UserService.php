<?php

namespace App\Services;

use App\Model\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class UserService
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAllUser()
    {
      return $this->userRepository->all();
    }
    public function getUserById(int $id)
    {
      return $this->userRepository->find($id);
    }

    public function createUser(array $data)
    {
    }

    public function updateUser(int $id, array $data)
    {

    }

    public function deleteUser(int $id)
    {

    }
}
