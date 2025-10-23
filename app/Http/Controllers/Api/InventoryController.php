<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Project\IncreaseStockRequest;
use App\Services\InventoryService;
use Illuminate\Http\JsonResponse;

class InventoryController extends BaseApiController
{
    protected InventoryService $inventoryService;

    /**
     * __construct
     *
     * @param  mixed $inventoryService
     * @return void
     */
    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function increaseStock(IncreaseStockRequest $request, int $productId): JsonResponse
    {
        $amount = $request->validated()['amount'];
        $success = $this->inventoryService->increaseStock($productId, $amount);

        if (!$success) {
            return $this->error('Failed to increase stock', 400);
        }

        return $this->successResponse(null, 'Stock increased successfully');
    }
}
