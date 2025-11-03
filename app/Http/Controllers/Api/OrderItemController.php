<?php

namespace App\Http\Controllers\Api;

use App\Services\OrderItemService;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class OrderItemController extends BaseApiController
{
    protected OrderItemService $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
        $this->middleware('auth:sanctum');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $order = $this->orderItemService->createOrderItem($validated);

        return $this->successResponse($order, 'Order item created successfully', 201);
    }

    /**
     * getItemsByOrder
     *
     * @param  mixed $orderId
     * @return JsonResponse
     */
    public function getItemsByOrder(int $orderId): JsonResponse
    {
        $items = $this->orderItemService->getItemsByOrder($orderId);

        return $this->successResponse($items, 'Order items retrieved successfully');
    }

    /**
     * getItemByProduct
     *
     * @param  mixed $productId
     * @return JsonResponse
     */
    public function getItemByProduct(int $productId): JsonResponse
    {
        $item = $this->orderItemService->getItemByProduct($productId);

        return $this->successResponse($item, 'Order item retrieved successfully');
    }

    /**
     * getItemsByUser
     *
     * @param  mixed $userId
     * @return JsonResponse
     */
    public function getItemsByUser(int $userId): JsonResponse
    {
        $item = $this->orderItemService->getItemsByUser($userId);

        return $this->successResponse($item, 'Order item retrieved by user successfully');
    }
}
