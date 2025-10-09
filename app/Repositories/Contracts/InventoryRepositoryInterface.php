<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface InventoryRepositoryInterface extends RepositoryInterface
{
    public function lowStock(int $limit = 10): Collection;
    public function adjustStock(int $productId, int $quantity): bool;
    public function increaseStock(int $productId, int $amount);
    public function decreaseStock(int $productId, int $amount): bool;
}
