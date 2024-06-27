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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('order_for')->constrained('users');
            $table->integer('cart_id')->nullable();
            // $table->enum('status', [0, 1])->default(1);
            $table->float('shipment_price')->nullable();
            $table->float('total_amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('status', ['Confirmed', 'shipped', 'Delivered'])->default('Confirmed');
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
