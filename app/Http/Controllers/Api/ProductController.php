<?php

namespace App\Http\Controllers\Api;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseApiController
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse($this->productService->getAvailableProducts(), 'Products retrieved successfully');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'category_id' => 'nullable|exists:categories,id',
            'created_by' => 'nullable|exists:users,id',
        ]);

        $validated['created_by'] = Auth::id();
        $product = $this->productService->createProduct($validated);

        return $this->successResponse($product, 'Product created successfully', 201);
    }

    /**
     * findByCategory
     *
     * @param  mixed $categoryId
     * @return JsonResponse
     */
    public function findByCategory($categoryId): JsonResponse
    {
        $products = $this->productService->findByCategory((int) $categoryId);

        return $this->successResponse($products, 'Product by category retrieved successfully');
    }
    /**
     * findByName
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function findByName(Request $request): JsonResponse
    {
        $validated = $request->validate(['name' => 'required|string']);
        $product = $this->productService->findByName($validated['name']);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }
        return $this->successResponse($product, 'Product found successfully');
    }

    /**
     * lowStock
     *
     * @return JsonResponse
     */
    public function lowStock(): JsonResponse
    {
        $product = $this->productService->lowStock(10);
        return $this->successResponse($product, 'Low stock products retrieved');
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'is_available' => 'sometimes|boolean',
            'stock' => 'sometimes|nullable|integer|min:0',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $updated = $this->productService->updateProduct((int)$id, $validated);

        if (!$updated) {
            return $this->errorResponse('Product not found', 404);
        }

        $product = $this->productService->getProductDetails((int)$id);
        return $this->successResponse($product, 'Product updated successfully');
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $deleted = $this->productService->deleteProduct((int)$id);

        if (!$deleted) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse(null, 'Product deleted successfully');
    }

    /**
     * restore
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function restore($id): JsonResponse
    {
        $restored = $this->productService->restoreProduct((int)$id);

        if (!$restored) {
            return $this->errorResponse('Product not found or not deleted', 404);
        }

        return $this->successResponse(null, 'Product restored successfully');
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $product = $this->productService->getProductDetails((int)$id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse($product, 'Product retrieved successfully');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function edit(string $id): JsonResponse
    {
        $product = $this->productService->getProductDetails((int)$id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse($product, 'Product edit data retrieved');
    }
}
