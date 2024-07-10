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
            $table->decimal('price', 10, 2)->nullable();
            $table->string('part_number')->nullable();
            $table->text('other_specification')->nullable();
            $table->text('Specifications_and_dimensions')->nullable();
            $table->text('Shipping_info')->nullable();
            $table->text('field_3')->nullable();
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
