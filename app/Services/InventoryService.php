<?php

namespace App\Services;

use App\Repositories\Contracts\InventoryRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlert;
class InventoryService
{
    protected InventoryRepositoryInterface $inventoryRepository;

    /**
     * __construct
     *
     * @param  mixed $inventoryRepository
     * @return void
     */
    public function __construct(InventoryRepositoryInterface $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    /**
     * increaseStock
     *
     * @param  mixed $productId
     * @param  mixed $amount
     * @return bool
     */
    public function increaseStock(int $productId, int $amount): bool
    {
        $success = $this->inventoryRepository->increaseStock($productId, $amount);

        $product = $this->inventoryRepository->find($productId);
        if ($product && $product->stock < 10) {
            Mail::to('admin@example.com')->queue(new LowStockAlert($product));
        }

        return $success;
    }
}
