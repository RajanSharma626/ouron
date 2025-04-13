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
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('detail')->nullable();
            $table->text('shipping_Return')->nullable();
            $table->decimal('price', 10, 2);
            $table->json('sizes')->nullable(); // Store sizes as JSON
            $table->json('colors')->nullable(); // Store colors as JSON
            $table->string('gender')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('stock')->default(0);
            $table->string('sku')->unique()->nullable();
            $table->string('weight')->nullable();
            $table->unsignedBigInteger('collection_id')->nullable(); // Corrected collection column
            $table->foreign('collection_id')->references('id')->on('collection')->onDelete('cascade');
            $table->integer('best_seller')->default(0);
            $table->unsignedBigInteger('category_id')->nullable(); // Corrected category column
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->json('images')->nullable(); // Store multiple images
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
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
