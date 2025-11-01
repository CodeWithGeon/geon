<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getAllCategory(): Collection;

    public function getByCategory(int $id): ?Category;

    public function createCategory(array $data): Category;

    public function updateCategory(int $id, array $data): ?Category;

    public function removeById(int $id): bool;
}
