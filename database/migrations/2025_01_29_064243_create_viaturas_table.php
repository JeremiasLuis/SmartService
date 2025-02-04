<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('viaturas', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->string('cor');
            $table->enum('tipo', ['Pequeno', 'Médio', 'Grande'])->default('Pequeno');
            $table->enum('estado', ['Entrada', 'Em Reparação', 'Concluído'])->default('Entrada');
            $table->string('tipo_avaria');
            $table->string('codigo_validacao')->unique();
            $table->foreignId('id_cliente')
            ->constrained('users','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('viaturas');
    }
};
