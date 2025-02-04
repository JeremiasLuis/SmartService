<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->enum('status',['aceite','recusado'])->default('aceite');

            $table->foreignId('id_servico')
            ->constrained('servicos','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('id_cliente')
            ->constrained('users','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
