<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;



//A Repository Interface defines what methods exist. (no logics)
interface RepositoryInterface
{
   /**
    * Get all records.
    */
   public function all(): Collection;

   /**
    * Find a record by its ID.
    */
   public function find($id): ?Model;

   /**
    * Create a new record.
    */
   public function create(array $attributes): Model;

   /**
    * Update a record by its ID.
    */
   public function update($id, array $attributes): bool;

   /**
    * Delete existing resource.
    *
    * @param int $id
    * @return bool
    */
   public function delete(int $id): bool;
}
