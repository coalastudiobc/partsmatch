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
        Schema::create('buyer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('shippo_address_id')->nullable();
            $table->string('selected_method_id')->nullable();
            $table->string('shipping_address_table_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_addresses');
    }
};
