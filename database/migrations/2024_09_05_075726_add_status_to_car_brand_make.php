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
        Schema::table('car_brand_makes', function (Blueprint $table) {
         $table->enum('status',[0,1])->default(1)->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_brand_makes', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
