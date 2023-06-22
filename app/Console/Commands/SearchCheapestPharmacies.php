<?php
namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class SearchCheapestPharmacies extends Command
{
    protected $signature = 'products:search-cheapest {productId}';

    protected $description = 'Find the 5 cheapest pharmacies for a given product ID';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $productId = $this->argument('productId');
        $product = Product::find($productId);

        if (!$product) {
            $this->error('Product not found.');
            return;
        }

        $pharmacies = $product->pharmacies()
            ->select('pharmacies.id', 'pharmacies.name', 'product_pharmacy.price', 'product_pharmacy.quantity')
            ->withPivot('price', 'quantity')
            ->take(5)
            ->get()
            ->toArray();

        if (count($pharmacies) === 0) {
            $this->info('No pharmacies found for the given product.');
            return;
        }

        $this->info('Cheapest 5 Pharmacies:');
        echo json_encode($pharmacies, JSON_PRETTY_PRINT);
    }
}