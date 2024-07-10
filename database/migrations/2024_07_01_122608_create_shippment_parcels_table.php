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
        Schema::create('shippment_parcels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shippment_creation_id');
            $table->foreign('shippment_creation_id')
                  ->references('id')->on('shippment_creations')
                  ->onDelete('cascade');
            $table->string('product_id')->nullable();
            $table->string('parcel_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippment_parcels');
    }
};
