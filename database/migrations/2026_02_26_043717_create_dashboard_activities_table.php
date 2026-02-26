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
        Schema::create('dashboard_activities', function (Blueprint $table) {
            $table->id();
            $table->string('user_name'); // "Maria Santos"
            $table->string('action'); // "created", "updated", "deleted"
            $table->string('module'); // "News", "Event", "Program", "Report", etc.
            $table->string('description'); // Full description
            $table->string('status'); // "published", "pending", "active", "archived", "inactive"
            $table->dateTime('action_time'); // When the action happened
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_activities');
    }
};
