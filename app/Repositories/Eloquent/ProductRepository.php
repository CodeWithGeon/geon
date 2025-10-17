<?php

namespace App\Repositories\Eloquent;
// data related logic for Product model
//Product for specific queries getAvailableProducts(), findByCategory()

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
    public function getAvailableProducts(): Collection
    {
        return $this->model->where('is_available', true)->get();
    }
    /**
     * createProduct
     *
     * @param  mixed $data
     * @return Product
     */
    public function createProduct(array $data): ?Product
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

    /**
     * findByCategory
     *
     * @param  mixed $categoryId
     * @return Collection
     */
    public function findByCategory($categoryId): Collection
    {
        return $this->model->where('category_id', $categoryId)->get();
    }
    /**
     * findByName
     *
     * @param  mixed $name
     * @return Product
     */
    /**
     * findByName
     *
     * @param  mixed $name
     * @return Product
     */
    public function findByName(string $name): ?Product
    {
        return $this->model->where('name', $name)->first();
    }
    /**
     * lowStock
     * fetch products with stock below a certain threshold
     * @param  mixed $limit
     * @return Collection
     */
    public function lowStock(int $limit = 10): Collection
    {
        return $this->model->where('stock', '<', $limit)->get();
    }
    /**
     * getProductById
     *
     * @param  mixed $id
     * @return Product
     */
    public function getProductById(int $id): ?Product
    {
        return $this->find($id);
    }
    /**
     * getActiveProducts
     *
     * @return Collection
     */
    public function getActiveProducts(): Collection
    {
        return $this->model->where('is_active', true)->get();
    }
}
