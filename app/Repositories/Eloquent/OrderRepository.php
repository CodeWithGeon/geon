<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getOrdersByUser(int $userId): Collection
    {
        return $this->model
            ->with('items.product', 'user')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function getOrdersByStatus(string $status): Collection
    {
        return $this->model
            ->with('items.product', 'user')
            ->where('status', $status)
            ->latest()
            ->get();
    }

    public function getAll(): Collection
    {
        return $this->model->with('items.product', 'user')->latest()->get();
    }

    public function getById(int $id): ?Order
    {
        return $this->model->with('items.product', 'user')->find($id);
    }

    public function createOrder(array $attributes): Order
    {
        return $this->model->create($attributes);
    }
}
