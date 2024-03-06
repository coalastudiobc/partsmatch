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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_details_id')->nullable();
            $table->string('password');
            $table->string('working_for')->nullable();
            $table->string('profile_picture_file')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'APPROVED', 'REJECTED'])->default('ACTIVE');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
