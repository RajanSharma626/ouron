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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pin_code');
            $table->string('phone');
            $table->string('payment_method');
            $table->string('coupon')->nullable();
            $table->string('coupon_value')->nullable();
            $table->string('coupon_type')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('total', 10, 2);
            $table->string('status')->default('Pending');
            $table->string('return_reason')->nullable();
            $table->string('return_image')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('payment_status')->nullable()->default('Pending');
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
