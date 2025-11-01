<?php

namespace App\Http\Controllers\Api;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends BaseApiController
{
    //Inherits from BaseApiController
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
        $this->middleware('auth:sanctum');
    }

    /**
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $order = $this->orderService->createOrder($validated);

        return $this->successResponse($order, 'Order created successfully', 201);
    }
    /**
     * Get all orders that belong to a specific user.
     *
     * @param  mixed $userId
     * @return JsonResponse
     */
    public function userOrders(int $userId): JsonResponse
    {
        return $this->successResponse($this->orderService->getOrderByUser($userId), 'Orders retrieved successfully');
    }

    /**
     * Get all orders
     *
     * @param  mixed $status
     * @return JsonResponse
     */
    public function ByStatus(string $status): JsonResponse
    {
        return $this->successResponse($this->orderService->getOrdersByStatus($status), 'Orders retrieved successfully');
    }


    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse($this->orderService->getAllOrders(), 'Orders retrieved successfully');
    }

    /**
     * Get a single order by its ID.
     */
    public function show(int $id): JsonResponse
    {
        return $this->successResponse($this->orderService->getOrderById($id), 'Order retrieved successfully');
    }
}
