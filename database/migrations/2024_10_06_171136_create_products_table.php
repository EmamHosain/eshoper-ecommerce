<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

            $table->string('product_name')->unique();
            $table->string('slug');


            // Additional columns
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->tinyInteger('is_discount')->default(0);


            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->text('short_description');


            $table->string('code')->nullable();
            $table->integer('quantity')->default(1);

            $table->tinyInteger('status')->default(1);

            $table->enum('popularity', ['trandy', 'arrived']);

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
