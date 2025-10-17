<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class InventoryController extends Controller
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
    /**
     * increaseStock
     *
     * @param  mixed $request
     * @param  mixed $productId
     * @return RedirectResponse
     */
    public function increaseStock(Request $request, int $productId): RedirectResponse
    {
        $amount = (int) $request->input('amount', 0);
        $this->inventoryService->increaseStock($productId, $amount);

        return redirect()->back()->with('success', 'Stock increased successfully!');
    }
}
