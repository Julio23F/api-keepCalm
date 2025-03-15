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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('entreprise_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('contrat_user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['entreprise_id']);
            $table->dropForeign(['contrat_user_id']);
            $table->dropColumn(['entreprise_id', 'contrat_user_id']);
            $table->string('name')->change();
        });
    }
};
