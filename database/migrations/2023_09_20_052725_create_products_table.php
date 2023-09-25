<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name',20);
            $table->integer('category_id');
            $table->integer('supplier_id')->nullable();
            $table->string('buying_price',20)->nullable();
            $table->string('selling_price',20);
            $table->string('product_qty',10);
            $table->string('stock',20)->nullable();
            $table->string('image',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
