<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

//inherits all CRUD method definitions (all, find, create, update, delete) from the base RepositoryInterface.

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getAvailableProducts(): Collection;
    public function createProduct(array $data): Product;
    public function findByCategory($categoryId): Collection;
    public function findByName(string $name): ?Product;
    public function lowStock(int $limit = 10): Collection;

}
