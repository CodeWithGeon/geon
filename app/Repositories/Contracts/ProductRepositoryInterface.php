<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

//inherits all CRUD method definitions (all, find, create, update, delete) from the base RepositoryInterface.
interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getAvailableProducts(): Collection; //Fetch products with status = 'available'
    //READ -> Collection of products
    public function findByName(string $name): ?Product; //Find products by name

    public function createProduct(array $data); //Create new product record
    //WRITE -> Single created product
}
