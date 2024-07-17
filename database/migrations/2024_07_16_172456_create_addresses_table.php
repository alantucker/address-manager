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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_name', 60);
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city', 30)->nullable();
            $table->string('county', 30);
            $table->string('postcode', 8);
            $table->string('country', 65);
            $table->decimal('longitude', 11,8)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
