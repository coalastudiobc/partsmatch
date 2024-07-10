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
        Schema::create('shippo_purchased_labels', function (Blueprint $table) {
            $table->id();
            $table->string('rate_id')->nullable();
            $table->string('shippment_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('rate_provider')->nullable();
            $table->string('service_level_token')->nullable();
            $table->integer('days')->nullable();
            $table->string('result')->nullable();
            $table->string('master_rateId')->nullable();
            $table->string('tracking_number')->nullable();
            $table->text('tracking_url')->nullable();
            $table->text('label_url')->nullable();
            $table->string('qr_code_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippo_purchased_labels');
    }
};
