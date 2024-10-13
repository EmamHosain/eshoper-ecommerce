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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('sub_total', 10, 2);
            $table->decimal('shipping_amount', 10, 2)->default(0.00);
            $table->string('coupon_code')->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('grand_total');
            $table->string('order_status')->default('pending');
            $table->text('notes')->nullable();
            $table->string('order_id');

            // Shipping Address fields (nullable if "Ship to different address" is not selected)
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');

            $table->enum('shipping_type', [
                'inside_dhaka',
                'outside_dhaka',
                'cash_on_delivery'
            ])->default('cash_on_delivery');


            $table->enum('peyment_method_type', [
                'bkash',
                'nagad',
                'cash_on_delivery'
            ])->default('cash_on_delivery');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
