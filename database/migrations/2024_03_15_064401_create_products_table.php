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
            $table->string('name')->nullable();
            $table->foreignId('user_id');
            $table->string('subcategory_id');
            $table->text('description')->nullable();
            $table->text('additional_details')->nullable();
            $table->string('stocks_avaliable')->nullable();
            $table->integer('price')->nullable();
            $table->integer('shipping_price')->nullable();
            $table->text('other_specification')->nullable();
            $table->string('year')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->enum('status', [0, 1])->default(1);
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
