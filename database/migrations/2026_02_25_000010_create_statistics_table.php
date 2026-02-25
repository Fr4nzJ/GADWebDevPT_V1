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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('e.g., Direct Beneficiaries');
            $table->string('value')->comment('The number or stat value');
            $table->string('label')->comment('e.g., Direct Beneficiaries');
            $table->string('icon')->nullable()->comment('FontAwesome icon class');
            $table->string('color')->default('blue')->comment('blue, green, orange, purple');
            $table->string('page')->default('home')->comment('which page: home, about, etc');
            $table->integer('order')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
