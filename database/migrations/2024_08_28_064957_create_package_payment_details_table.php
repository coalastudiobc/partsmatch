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
        Schema::create('package_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('plan_id')->nullable()->constrained('users');
            $table->string('plan_name')->nullable();
            $table->string('plan_amount')->nullable();
            $table->string('plan_type')->nullable();
            $table->integer('plan_product_count')->nullable();
            $table->string('transcation_id')->nullable();
            $table->text('stripe_raw_data')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_payment_details');
    }
};
