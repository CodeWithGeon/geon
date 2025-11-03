<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Auth;


class OrderItemService
{
    protected OrderItemRepositoryInterface $orderItemRepository;

    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * createOrderItem
     *
     * @param  mixed $data
     * @return OrderItem
     */
    public function createOrderItem(array $data): OrderItem
    {
        $attributes = collect($data)
            ->only(['order_id', 'product_id', 'quantity', 'unit_price'])
            ->toArray();

        // Automatically compute subtotal
        $attributes['subtotal'] = $attributes['quantity'] * $attributes['unit_price'];


        $attributes['created_by'] = Auth::id();

        return $this->orderItemRepository->createItem($attributes);
    }

    /**
     * getItemsByOrder
     *
     * @param  mixed $orderId
     * @return Collection
     */
    public function getItemsByOrder(int $orderId): Collection
    {
        return $this->orderItemRepository->getItemsByOrder($orderId);
    }


    /**
     * getItemByProduct
     *
     * @param  mixed $productId
     * @return Collection
     */
    public function getItemByProduct(int $productId): Collection
    {
        return $this->orderItemRepository->getItemsByProduct($productId);
    }

    public function getItemsByUser(int $userId): Collection
    {
      return $this->orderItemRepository->getItemsByUser($userId);
    }
}
