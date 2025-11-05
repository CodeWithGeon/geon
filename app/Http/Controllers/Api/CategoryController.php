<?php

namespace App\Http\Controllers\Api;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class CategoryController extends BaseApiController
{
   protected CategoryService $categoryService;

   public function __construct(CategoryService $categoryService)
   {
    $this->categoryService = $categoryService;
    $this->middleware('auth:sanctum')->except(['index' , 'show']);
   }
    public function index(): JsonResponse
    {
       return $this->successResponse($this->categoryService->getAllCategory());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'created_by' => 'nullable|exists:user,id',

        ]);
        $category = $this->categoryService->createCategory($validated);

         return $this->successResponse($category,'Category updated successfully', 201);
    }


    public function show(int $id): JsonResponse
    {
       return $this->successResponse($this->categoryService->getByCategory($id));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' =>'sometimes|required|max:255',
            'description' => 'nullable|string'
        ]);
        $category = $this->categoryService->updateCategory($id, $validated);

        return $this->successResponse($category,'Category updated successfully', 201 );
    }


    public function destroy(int $id): JsonResponse
    {
        return $this->successResponse($this->categoryService->removeById($id));
    }
}
