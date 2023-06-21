<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::all();
    }

    public function find($id)
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

    public function findCheapestPharmacies($productId, $limit = 5)
    {
        return Product::find($productId)
            ->pharmacies()
            ->orderBy('pharmacy_product.price', 'asc')
            ->take($limit)
            ->get();
    }
}
