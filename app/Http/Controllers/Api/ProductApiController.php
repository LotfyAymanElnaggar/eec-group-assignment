<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request, ProductService $productService)
    {
        $validatedData = $request->validate([
            'perPage' => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:100'
            ],
            'search' => [
                'nullable',
                'string',
                'max:255'
            ],
            'page' => [
                'sometimes',
                'required',
                'integer',
                'min:1'
            ],
        ]);

        $perPage = $validatedData['perPage'] ?? 10;
        $search = $validatedData['search'] ?? '';
        $page = $validatedData['page'] ?? 1;

        $products = $productService->search($search, $perPage, $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $products->total(),
            'recordsFiltered' => $products->total(),
            'data' => $products->items()
        ]);
    }

    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = $request->all();
        $product = $this->productService->createProduct($productData);
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        return $request->all();
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = [$request];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            // Save the image path to the product's data array
            $productData['image'] = substr($imagePath, strlen('public/'));
        }

        $this->productService->updateProduct($id, $productData);
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
