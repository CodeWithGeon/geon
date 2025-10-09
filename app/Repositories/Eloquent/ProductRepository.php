<?php

namespace App\Repositories\Eloquent;
// data related logic for Product model
//Extends BaseRepository and adds model-specific logic (e.g. getAvailableProducts()

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model); //instance of the model
    }
    //fetch all products that are marked as available
    public function getAvailableProducts(): Collection
    {
        return $this->model->where('is_available', true)->get();

        
    }

    public function createProduct(array $data)
    {
        try {
            $product = $this->model->create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'],
                'stock' => $data['stock'] ?? 0,
                'is_available' => $data['is_available'] ?? true,
            ]);

            return $product;
        } catch (\Exception $e) {
            $this->logError('Failed to create product', $e, ['data' => $data]);
            throw new \Exception('Unable to create product.');
        }
    }


    // Fetch a product by its name
    public function findByName(string $name): ?Product
    {
        return $this->model->where('name', $name)->first();
    }

    // Fetch products with stock below a certain threshold
    public function lowStock(int $limit = 10): Collection
    {
        return $this->model->where('stock', '<', $limit)->get();
    }
}
