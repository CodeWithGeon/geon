<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
// ProductService depends on ProductRepositoryInterface via dependency injection.
// ProductRepositoryInterface → ProductRepository (Eloquent)
class ProductService
{

    /**
     * ProductService
     * 
     * Contains business logic for products.
     * Depends on ProductRepositoryInterface for data operations.
     * Keeps controllers thin and clean by isolating core logic here.
     */
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function createProduct(array $data)
    {

        $attributes = collect($data)
            ->only(['name', 'description', 'price', 'stock', 'is_available'])
            ->toArray();

        // Then call the repo’s custom method
        return $this->productRepository->createProduct($attributes);
    }


    public function getAvailableProducts()
    {   // Business logic before returning products
        return $this->productRepository->getAvailableProducts();
    }
}
