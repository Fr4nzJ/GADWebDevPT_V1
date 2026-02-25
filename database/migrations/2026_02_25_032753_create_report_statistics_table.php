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
        Schema::create('report_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('number');
            $table->string('subtitle')->nullable();
            $table->string('icon')->nullable();
            $table->string('gradient_start')->default('#667eea');
            $table->string('gradient_end')->default('#764ba2');
            $table->string('page')->default('reports');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('page');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_statistics');
    }
};
