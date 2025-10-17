<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(): Collection;
    public function find($id): ?Model;
    public function create(array $data): Model;
    public function update($id, array $attributes): bool;
    public function delete(int $id): bool;
    public function restore($id);
}
