<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyProductTable extends Migration
{
    public function up()
    {
        Schema::create('pharmacy_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacy_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreign('pharmacy_id')
                ->references('id')
                ->on('pharmacies');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');

            // Set the composite primary key using product_id and pharmacy_id
            $table->unique(['product_id', 'pharmacy_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pharmacy_product');
    }
}
