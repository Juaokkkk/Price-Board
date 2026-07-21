<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cria a coluna apenas se ela não existir
        if (!Schema::hasColumn('produtos', 'codigo')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->unsignedInteger('codigo')->after('id');
            });
        }

        // Cria o índice apenas se ele não existir
        $indice = DB::select("
            SELECT COUNT(*) AS total
            FROM information_schema.statistics
            WHERE table_schema = DATABASE()
              AND table_name = 'produtos'
              AND index_name = 'produtos_user_id_codigo_unique'
        ");

        if ($indice[0]->total == 0) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->unique(['user_id', 'codigo']);
            });
        }
    }

    public function down(): void
    {
        $indice = DB::select("
            SELECT COUNT(*) AS total
            FROM information_schema.statistics
            WHERE table_schema = DATABASE()
              AND table_name = 'produtos'
              AND index_name = 'produtos_user_id_codigo_unique'
        ");

        if ($indice[0]->total > 0) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->dropUnique('produtos_user_id_codigo_unique');
            });
        }

        if (Schema::hasColumn('produtos', 'codigo')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->dropColumn('codigo');
            });
        }
    }
};