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
            $table->longText('description');
            $table->enum('category', ['women_empowerment', 'education', 'safety', 'leadership', 'lgbtq', 'mainstreaming']);
            $table->enum('status', ['ongoing', 'completed', 'upcoming', 'suspended'])->default('ongoing');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('beneficiaries')->default(0);
            $table->bigInteger('budget')->default(0);
            $table->string('location')->nullable();
            $table->json('objectives')->nullable();
            $table->text('target_group')->nullable();
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
