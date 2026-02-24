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
        Schema::table('contacts', function (Blueprint $table) {
            $table->longText('reply_message')->nullable()->after('message');
            $table->timestamp('replied_at')->nullable()->after('reply_message');
            $table->foreignId('replied_by')->nullable()->constrained('users')->nullOnDelete()->after('replied_at');
            $table->string('status')->default('new')->after('replied_by'); // new, read, replied, archived
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['replied_by']);
            $table->dropColumn(['reply_message', 'replied_at', 'replied_by', 'status']);
        });
    }
};
