<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getOrdersByUser(int $userId): Collection;
    public function getOrdersByStatus(string $status): Collection;
    public function getAll(): Collection;
    public function getById(int $id): ?Order;
    public function createOrder(array $attributes): Order;
}
