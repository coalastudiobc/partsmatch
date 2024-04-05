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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->float('price')->nullable();
            $table->enum('billing_cycle', ['Mounthly', 'Every 3 months', 'Every 6 months', 'Yearly'])->default('Mounthly');
            $table->integer('trial_days')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_price')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
