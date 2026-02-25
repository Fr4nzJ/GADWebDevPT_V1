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
        Schema::create('program_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // e.g., "Active Programs", "Total Beneficiaries"
            $table->string('value'); // e.g., "8", "250K+", "₱600M+"
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->string('color')->nullable(); // Color code (e.g., #667eea, #48c774)
            $table->string('background_class')->nullable(); // CSS class (e.g., has-background-success-light)
            $table->string('page')->default('programs'); // which page to display on
            $table->integer('order')->default(0); // sort order
            $table->text('description')->nullable(); // Additional description
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('page');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_statistics');
    }
};
