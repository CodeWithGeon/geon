<?php
//Repository = talks to the database (Model)
namespace App\Repositories\Eloquent;
// Implements the actual logic. Generic implementation of RepositoryInterface.
// Handles data access (CRUD, DB queries)

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;


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
   protected function logError(string $message, \Exception $e, array $context = []): void
   {
      Log::error($message, array_merge([
         'error' => $e->getMessage(),
         'trace' => $e->getTraceAsString(),
      ], $context));
   }
}
