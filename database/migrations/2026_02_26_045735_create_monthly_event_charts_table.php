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
        Schema::create('monthly_event_charts', function (Blueprint $table) {
            $table->id();
            $table->string('month'); // January, February, etc.
            $table->integer('value'); // Number of events for that month
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
        Schema::dropIfExists('monthly_event_charts');
    }
};
