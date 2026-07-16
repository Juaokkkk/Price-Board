<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            // Mercado/usuário dono do banner
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Imagem do banner
            $table->string('imagem');

            // Nome opcional para identificação no painel
            $table->string('titulo')->nullable();

            // Controle de exibição
            $table->boolean('ativo')->default(true);

            // Ordem no slideshow
            $table->integer('ordem')->default(0);

            // Datas para campanhas
            $table->date('inicio')->nullable();
            $table->date('fim')->nullable();

            // Tempo que fica na tela (segundos)
            $table->integer('duracao')->default(5);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};