<?php

namespace App\Repositories\Contracts;

use App\Models\OrderItem;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;



interface OrderItemRepositoryInterface extends RepositoryInterface
{
    public function getItemsByOrder(int $orderId): Collection;

    public function getItemsByProduct(int $productId): Collection;

    public function createItem(array $data): OrderItem;
}
