<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

//inherits all CRUD method definitions (all, find, create, update, delete) from the base RepositoryInterface.
//defines methods for accessing product data specific to the Product model.
interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getAvailableProducts(): Collection;
    public function findByName(string $name): ?Product;
    public function createProduct(array $data): Product;
    public function findByCategory($categoryId): Collection;
    public function lowStock(int $limit = 10): Collection;
    public function restore($id);
    public function getProductById(int $id): ?Product;
}
