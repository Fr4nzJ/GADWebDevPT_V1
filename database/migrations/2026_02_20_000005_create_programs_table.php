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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->enum('category', [
                'women_empowerment',
                'education',
                'safety',
                'leadership',
                'lgbtq',
                'mainstreaming',
            ])->default('women_empowerment');
            $table->enum('status', ['active', 'inactive', 'completed', 'on_hold'])->default('active');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('beneficiaries')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('location')->nullable();
            $table->json('objectives')->nullable();
            $table->string('target_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
