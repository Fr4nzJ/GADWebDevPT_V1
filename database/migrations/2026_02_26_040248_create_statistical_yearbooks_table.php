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
        Schema::create('statistical_yearbooks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('publication_date')->nullable();
            $table->integer('pages')->nullable();
            $table->string('format')->nullable(); // PDF, PDF + Excel, etc
            $table->string('languages')->nullable(); // JSON or comma-separated
            $table->string('file_path')->nullable();
            $table->string('download_size')->nullable(); // e.g., "15 MB"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistical_yearbooks');
    }
};
