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
        Schema::create('page_values', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['objective', 'value', 'mandate', 'goal', 'vision', 'mission', 'achievement']);
            $table->text('content');
            $table->string('page')->default('about');
            $table->integer('order')->default(0);
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_values');
    }
};
