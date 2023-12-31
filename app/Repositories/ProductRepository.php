<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function all(): Collection
    {
        return Product::all();
    }

    public function getAll($perPage = null): LengthAwarePaginator
    {
        return $perPage ? Product::paginate($perPage) : Product::get();
    }

    public function find($id): Product
    {
        return Product::find($id);
    }

    public function create($data)
    {
        return Product::create($data);
    }

    public function update($id, $data)
    {
        return Product::find($id)->update($data);
    }

    public function delete($id)
    {
        return Product::find($id)->delete();
    }

    public function attachPharmacy(Product $product, Pharmacy $pharmacy, float $price, int $quantity)
    {
        $product->pharmacies()->attach($pharmacy->id, [
            'price' => $price,
            'quantity' => $quantity
        ]);
    }

    public function findCheapestPharmacies($productId, $limit = 5): Collection
    {
        return Product::find($productId)
            ->pharmacies()
            ->orderBy('pharmacy_product.price', 'asc')
            ->take($limit)
            ->get();
    }

    public function searchProductsByName(string $searchTerm): Collection
    {
        return Product::query()
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->get();
    }

    public function search(string $search = '', int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        $query = Product::query();

        if (!empty($search)) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

}
