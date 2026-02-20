<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('excerpt')->nullable();
            $table->string('category')->default('General');
            $table->string('author')->default('Admin');
            $table->enum('status', ['draft', 'pending', 'published', 'archived'])->default('draft');
            $table->json('images')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
            
            $table->index('status');
            $table->index('category');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
