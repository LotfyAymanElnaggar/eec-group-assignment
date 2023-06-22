<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request->all());
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $this->productService->updateProduct($id, $request->all());
        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function cheapestPharmacies($productId)
    {
        $pharmacies = $this->productService->getCheapestPharmacies($productId);
        return response()->json($pharmacies);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = $this->productService->searchProductsByName($searchTerm);

        return response()->json(['products' => $products]);
    }
}
