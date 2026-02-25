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
        Schema::create('chart_data', function (Blueprint $table) {
            $table->id();
            $table->enum('chart_type', ['growth', 'distribution'])->default('growth');
            $table->string('label'); // Year or category name
            $table->integer('value');
            $table->string('page')->default('home'); // Which page this appears on
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('chart_type');
            $table->index('page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_data');
    }
};
