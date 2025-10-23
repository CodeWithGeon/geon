<?php
namespace App\Repositories\Eloquent;
//data-related logic for inventory management.
// Handles DB logic
use App\Models\Product;
use App\Repositories\Contracts\InventoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
// Implements inventory logic but still uses the Product model:
class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function lowStock(int $limit = 10): Collection
    {
        return $this->model->where('stock', '<', $limit)->get();
    }

    public function adjustStock(int $productId, int $quantity): bool
    {
        $product = $this->model->find($productId);
        if (!$product) return false;

        $product->stock += $quantity;
        return $product->save();
    }

    public function increaseStock(int $productId, int $amount): bool
    {
        return $this->adjustStock($productId, +$amount);
    }

    public function decreaseStock(int $productId, int $amount): bool
    {
        return $this->adjustStock($productId, -$amount);
    }
}
