<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('products.index');
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $pageTitle = "Add Product";
        return view('products.form', compact('pageTitle'));
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $pageTitle = "Edit Product";
        return view('products.form', compact('product', 'pageTitle'));
    }
}
