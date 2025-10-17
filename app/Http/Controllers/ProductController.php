<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Validates data, delegates business logic to the ProductService,
     * and returns appropriate JSON or view responses.
     */
    protected ProductService $productService; // Dependency injection of ProductService
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('admin')->except(['index', 'show', 'edit']);
    }

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->productService->getAvailableProducts());
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
            'is_available' => 'boolean',
            'stock' => 'nullable|integer|min:0',
            'created_by' => 'nullable|exists:users,id',
        ]);
        $Validated['created_by'] = Auth::id();

        $product = $this->productService->createProduct($validated);

        return response()->json($product, 201);
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
        $updated = $this->productService->updateProduct((int)$id, $request->all());

        if (!$updated) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product updated successfully']);
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
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product deleted successfully']);
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
            return response()->json(['message' => 'Product not found or not deleted'], 404);
        }
        return response()->json(['message' => 'Product restored successfully']);
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
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductDetails((int)$id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
}
