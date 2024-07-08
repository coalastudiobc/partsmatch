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
        Schema::create('shippment_creations', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('shippment_id')->nullable();
            $table->string('address_from')->nullable();
            $table->string('address_to')->nullable();
            $table->timestamp('shippment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippment_creations');
    }
};
