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
        Schema::create('category_sliders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->tinyInteger('status')->default(1);
            $table->text('heading_one')->nullable();
            $table->text('heading_two')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('slider_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_sliders');
    }
};
