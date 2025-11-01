<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface


{
    public function __construct(Category $model)
     {
        parent::__construct($model);
     }
    public function getAllCategory(): Collection
    {
      return $this->model->all();
    }

    public function getByCategory(int $id): ?Category
    {
      return $this->model->find($id);
    }

    public function createCategory(array $data): Category
    {
        $data['created_by'] = Auth::id();
      return $this->model->create( $data);
    }

    public function updateCategory($id, array $data): ?Category
    {
       $category = $this->model->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function removeById(int $id): bool
    {

       $category = $this->model->findOrFail($id);
        return $category->delete();
    }

}
