<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use SebastianBergmann\Type\TrueType;
//Concrete Repository for Product model (eg. UserRepository for User model, etc.)
//Extends BaseRepository and adds model-specific logic (e.g. getAvailableProducts()
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model); //instance of the model
    }
    // Fetch all products that are marked as available
    // BaseRepository already has basic CRUD methods
    


    //fetch all products that are marked as available
    public function getAvailableProducts()
    {
        return $this->model->where('status', 'is_available', true)->get();
    }

    // Fetch a product by its name
    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
    
    // Fetch products with stock below a certain threshold
    public function lowStock($limit = 10)
    {
        return $this->model->where('stock', '<', $limit)->get();
    }

}
