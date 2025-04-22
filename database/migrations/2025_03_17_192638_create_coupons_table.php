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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->enum('for_type', ['all', 'category', 'collection', 'product'])->default('all');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->decimal('discount_value', 10, 2);
            $table->enum('coupon_type', ['percentage', 'fixed_amount', 'free_shipping']);
            $table->enum('status', ['active', 'inactive', 'future']);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collection')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
