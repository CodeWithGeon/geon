<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAvailableProducts(): Collection
    {
        return $this->productRepository->getAvailableProducts();
    }


    public function createProduct(array $data): Product
    {
        if (($data['stock'] ?? 0) <= 0) {
            $data['is_available'] = false;
        }
        $attributes = collect($data)
            ->only(['name', 'description', 'price', 'stock', 'is_available', 'is_active', 'category_id', 'created_by'])
            ->toArray();

        $attributes['created_by'] = Auth::id();

        return $this->productRepository->createProduct($attributes);
    }


    public function findByCategory(int $categoryId): Collection
    {
        return $this->productRepository->findByCategory($categoryId);
    }


    public function findByName(string $name): ?Product
    {
        return $this->productRepository->findByName($name);
    }


    public function lowStock(int $limit = 10): Collection
    {
        return $this->productRepository->lowStock($limit);
    }

    public function updateProduct(int $id, array $data): bool
    {
        if (isset($data['stock']) && $data['stock'] <= 0) {
            $data['is_available'] = false;
        }
        $attributes = collect($data)
            ->only(['name', 'description', 'price', 'stock', 'is_available', 'is_active', 'category_id'])

            ->toArray();

        return $this->productRepository->update($id, $attributes);
    }

    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
    public function restoreProduct(int $id)
    {

        return $this->productRepository->restore($id);
    }


    public function getProductDetails(int $id)
    {
        return $this->productRepository->find($id);
    }
}
