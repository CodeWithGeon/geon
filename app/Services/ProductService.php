<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) //ProductRepositoryInterface implementation injected via constructor
    {
        $this->productRepository = $productRepository;
    }


    /**
     * createProduct
     *
     * @param  mixed $data
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        if (($data['stock'] ?? 0) <= 0) {
            $data['is_available'] = false;
        }
        $attributes = collect($data)
            ->only(['name', 'description', 'price', 'stock', 'is_available'])
            ->toArray();

        $attributes['created_by'] = Auth::id();

        return $this->productRepository->createProduct($attributes);
    }
    /**
     * getAvailableProducts
     *
     * @return Collection
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
     *
     */
    public function restoreProduct(int $id)
    {

        return $this->productRepository->restore($id);
    }

    /**
     * getProductDetails
     *
     * @param  mixed $id
     * @return
     */
    public function getProductDetails(int $id)
    {
        return $this->productRepository->find($id);
    }
}
