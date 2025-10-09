<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController
     * 
     * Handles incoming HTTP requests related to products.
     * Validates data, delegates business logic to the ProductService,
     * and returns appropriate JSON or view responses.
     */
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->getAvailableProducts();
    }

    public function store(Request $request)
    {  // validate input
        $Validated = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'price'=>'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_available' => 'boolean',
            
        ]);

        //Call the service (not repository directly)
        $product = $this->productService->createProduct($Validated);

        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
