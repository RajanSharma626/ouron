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
            $table->string('code')->unique();
            $table->decimal('discount', 8, 2); // Flat discount amount
            $table->enum('discount_type', ['percentage', 'fixed'])->default('fixed'); // Type of discount
            $table->integer('usage_limit')->default(1); // Limit on usage
            $table->integer('used')->default(0); // Number of times used
            $table->timestamp('expires_at')->nullable(); // Expiration date
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
