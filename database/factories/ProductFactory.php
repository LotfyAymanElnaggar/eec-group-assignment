<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'title' => ucwords($this->faker->word . ' ' . $this->faker->randomElement(['Device', 'Tool', 'Accessory'])),
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(640, 480, 'product'),
        ];
    }
}
