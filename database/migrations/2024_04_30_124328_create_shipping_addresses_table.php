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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('country_id');
            $table->foreignId('state_id');
            $table->foreignId('city_id');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->integer('post_code')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
