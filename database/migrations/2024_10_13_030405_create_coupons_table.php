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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            // the discount coupon code
            $table->string('code')->unique();

            // the human readable discount coupon code name
            $table->string('name')->nullable();

            // the description of the coupon  - not necessary
            $table->text('description')->nullable();

            // the max uses this discount coupon has
            $table->integer('max_uses')->nullable();

            // how many times a user can use this coupon 
            $table->integer('max_uses_user')->nullable();

            // wheather or not the coupon is a percentage or a fixed price.
            $table->enum('type', [
                'percent',
                'fixed'
            ])->default('fixed');

            $table->tinyInteger('status')->default(1);

            // the amount to discount based on type
            $table->decimal('discount_amount', 10, 2);


            // user wil apply  coupon code  when the min_amount is greater then sub_total amount
            $table->decimal('min_amount', 10, 2);


            // when the coupon begins
            $table->timestamp('starts_at')->nullable(); // optional

            // when the coupon ends
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
