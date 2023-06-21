<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    private $count;
    private $max;

    public function __construct($count, $max = 10000)
    {
        $this->$count = $count;
        $this->$max = $max;
    }

    public function run()
    {
        Pharmacy::factory()->count($this->count)->create()->each(function ($pharmacy) {
            // Attach random products to the pharmacy with a random quantity
            $productIds = Product::inRandomOrder()->take(rand(2000, 5000))->pluck('id');
            $pharmacy->products()->attach($productIds->toArray(), ['quantity' => rand(1, $this->max)]);
        });
    }
}
