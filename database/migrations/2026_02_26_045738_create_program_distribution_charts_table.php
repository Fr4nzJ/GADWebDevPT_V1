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
        Schema::create('program_distribution_charts', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // "VAWG Prevention", "Women Entrepreneurship", etc.
            $table->integer('value'); // The number for the chart
            $table->string('color_hex')->nullable(); // Color code like #667eea
            $table->integer('order')->default(0); // Sort order
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_distribution_charts');
    }
};
