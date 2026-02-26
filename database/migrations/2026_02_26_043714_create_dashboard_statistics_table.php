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
        Schema::create('dashboard_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // "News Posts", "Events Scheduled", etc.
            $table->integer('value'); // The number to display
            $table->string('icon_class')->default('fas fa-chart-bar'); // Font Awesome icon
            $table->string('color_class')->default('blue'); // blue, purple, green, orange, red
            $table->integer('trend_value')->nullable(); // e.g., 12
            $table->string('trend_direction')->default('up'); // up, down, flat
            $table->string('trend_text')->nullable(); // e.g., "12 this month"
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_statistics');
    }
};
