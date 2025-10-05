<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


//Common reusable CRUD methods for any model
// Base repository implementing common methods to all from my interfaces   
class BaseRepository implements RepositoryInterface
{
   protected $model;

   public function __construct(Model $model)
   {
      $this->model = $model;
   }

   public function all(): Collection
   {
      return $this->model->all();
   }

   public function find($id): ?Model
   {
      return $this->model->find($id);
   }

   public function create(array $attributes): Model
   {
      return $this->model->create($attributes);
   }

   public function update($id, array $attributes): bool
   {
      $record = $this->find($id);
      return $record ? $record->update($attributes) : false;
   }

   public function delete($id): bool
   {
      $record = $this->find($id);
      return $record ? $record->delete() : false;
   }
}
