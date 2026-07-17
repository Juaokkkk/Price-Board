<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {

            $table->unsignedInteger('codigo')->after('id');

            $table->unique(['user_id', 'codigo']);

        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {

            $table->dropUnique(['user_id', 'codigo']);

            $table->dropColumn('codigo');

        });
    }
};