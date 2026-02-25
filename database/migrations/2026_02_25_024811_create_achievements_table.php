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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('number'); // e.g., "250+", "8.5K", "42", "150+"
            $table->string('label'); // e.g., "Agencies with Gender Focal Persons"
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->string('page')->default('about'); // which page to display on
            $table->integer('order')->default(0); // sort order
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
        Schema::dropIfExists('achievements');
    }
};
