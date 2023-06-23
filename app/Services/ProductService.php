<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($perPage = null): LengthAwarePaginator
    {
        return $this->productRepository->getAll($perPage);
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct($data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getCheapestPharmacies($productId, $limit = 5): Collection
    {
        return $this->productRepository->findCheapestPharmacies($productId, $limit);
    }

    public function searchProductsByName(string $searchTerm): Collection
    {
        return $this->productRepository->searchProductsByName($searchTerm);
    }
}
