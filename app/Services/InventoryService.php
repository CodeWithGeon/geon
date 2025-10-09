<?php

namespace App\Services;

use App\Repositories\Contracts\InventoryRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlert;
// InventoryService depends on InventoryRepositoryInterface via dependency injection.
// InventoryRepositoryInterface → InventoryRepository (Eloquent)
class InventoryService
{
   protected InventoryRepositoryInterface $inventoryRepository;

   public function __construct(InventoryRepositoryInterface $inventoryRepository)
   {
      $this->inventoryRepository = $inventoryRepository;
   }

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
