<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * all
     *
     * @return Collection
     */
    public function all(): Collection //index
    {
        return $this->model->all();
    }

    /**
     * find
     *
     * @param  mixed $id
     * @return Model
     */
    public function find($id): ?Model //2,3
    {
        return $this->model->find($id);
    }

    /**
     * create
     *
     * @param  mixed $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $attributes
     * @return bool
     */
    public function update($id, array $attributes): bool
    {
        $record = $this->find($id);
        return $record ? $record->update($attributes) : false;
    }


    /**
     * restore
     *
     * @param  mixed $id
     * @return bool
     */
    // Restore a soft-deleted model
    public function restore($id): bool
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $model = $this->model->withTrashed()->findOrFail($id);
            return $model->restore();
        }
        return false;
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete($id): bool
    {
        $record = $this->find($id);
        return $record ? $record->delete() : false;
    }

    /**
     * query
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->query();
    }

    /**
     * logError
     *
     * @param  mixed $message
     * @param  mixed $e
     * @param  mixed $context
     * @return void
     */
    protected function logError(string $message, \Exception $e, array $context = []): void
    {
        Log::error($message, array_merge([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ], $context));
    }
}
