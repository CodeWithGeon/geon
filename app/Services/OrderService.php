<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\OrderItemService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected OrderRepositoryInterface $orderRepository;
    protected OrderItemService $orderItemService;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemService $orderItemService
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemService = $orderItemService;
    }

    /**
     * Create a new order with its items
     * Prepare order data
     * Return order with items
     * @return Order
     * @param  mixed $data
     */
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            //order fields
            $orderAttributes = [
                'status' => $data['status'] ?? 'pending',
                'user_id' => Auth::id(),
                'created_by' => Auth::id(),
                'total_amount' => 0,
            ];

            // Create order first
            $order = $this->orderRepository->create($orderAttributes);

            $totalAmount = 0;

            if (!empty($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $subtotal = $item['quantity'] * $item['unit_price'];
                    $totalAmount += $subtotal;

                    $this->orderItemService->createOrderItem([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'subtotal' => $subtotal,
                    ]);
                }
            }

            // Update total amount after all items are added
            $order->update(['total_amount' => $totalAmount]);

            return $order->load('items.product', 'user');
        });
    }

    /**
     * getOrderByUser
     *
     * @param  mixed $userId
     * @return Collection
     */
    public function getOrderByUser(int $userId): Collection
    {
        return $this->orderRepository->getOrdersByUser($userId);
    }


    public function getOrdersByStatus(string $status): collection
    {
        return $this->orderRepository->getOrdersByStatus($status);
    }

    /**
     * getAllOrders
     *
     * @return Collection
     */
    public function getAllOrders(): Collection
    {
        return $this->orderRepository->getAll();
    }

    /**
     * getOrderById
     *
     * @param  mixed $id
     * @return Order|null
     */
    public function getOrderById(int $id): ?Order
    {
        return $this->orderRepository->getById($id);
    }
}
