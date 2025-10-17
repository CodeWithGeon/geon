<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

// ProductService depends on ProductRepositoryInterface via dependency injection.
// Business logic validation, rules, transaction logic.
class ProductService
{
    /**
     * Contains business logic for products.
     */
    protected ProductRepositoryInterface $productRepository;
    /**
     * __construct
     *
     * @param  mixed $productRepository
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository) //ProductRepositoryInterface implementation injected via constructor
    {
        $this->productRepository = $productRepository;
    }
    /**
     * createProduct
     *
     * @param  mixed $data
     * @return void
     */
    public function createProduct(array $data): mixed
    {
        if (($data['stock'] ?? 0) <= 0) {
            $data['is_available'] = false;
        }
        $attributes = collect($data)
            ->only(['name', 'description', 'price', 'stock', 'is_available'])
            ->toArray();

        $product = $this->productRepository->createProduct($attributes);
        return $product;
    }

    /**
     * getAvailableProducts
     *
     * @return void
     */
    public function getAvailableProducts(): Collection
    {
        return $this->productRepository->getAvailableProducts();
    }

    /**
     * deleteProduct
     *
     * @param  mixed $id
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    /**
     * updateProduct
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return bool
     */
    public function updateProduct(int $id, array $data): bool
    {
        if (isset($data['stock']) && $data['stock'] <= 0) {
            $data['is_available'] = false;
        }
        $attributes = collect($data)
            ->only(['name', 'description', 'price', 'stock', 'is_available'])
            ->toArray();
        return $this->productRepository->update($id, $attributes);
    }

    /**
     * restoreProduct
     *
     * @param  mixed $id
     * @return void
     */
    public function restoreProduct(int $id)
    {
        return $this->productRepository->restore($id);
    }

    /**
     * getProductDetails
     *
     * @param  mixed $id
     * @return void
     */
    public function getProductDetails(int $id)
    {
        return $this->productRepository->find($id);
    }
}
