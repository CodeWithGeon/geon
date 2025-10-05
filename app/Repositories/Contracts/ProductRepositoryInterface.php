<?php

namespace App\Repositories\Contracts;

//Uses the interface RepositoryInterface
//Controller interface — Laravel injects the correct repository automatically
interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getAvailableProducts();

    public function findByName($name);

    public function lowStock($limit = 10);
}
