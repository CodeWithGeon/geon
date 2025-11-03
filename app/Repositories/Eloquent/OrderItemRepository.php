<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    public function getItemsByOrder(int $orderId): Collection
    {
        return $this->model->with('product')
            ->where('order_id', $orderId)
            ->get();
    }
    public function getItemsByUser(int $userId): Collection
    {
        return $this->model->with('product', 'order')
            ->whereHas('order', fn($q) => $q
            ->where('user_id', $userId))
            ->get();
    }

    public function getItemsByProduct(int $productId): Collection
    {
        return $this->model->with('order')
            ->where('product_id', $productId)
            ->get();
    }

    public function createItem(array $data): OrderItem
    {
        return $this->model->create($data);
    }
}
