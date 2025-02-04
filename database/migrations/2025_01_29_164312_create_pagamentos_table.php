<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->enum('metodo',['Em Mão','TPA'])->default('Em Mão');
            $table->enum('parcelar',['sim','não'])->default('não');
            $table->float('valor');
            $table->enum('status', ['Pendente','Em Pagamento', 'Finalizado'])->default('Pendente');

            $table->string('observacao')->nullable();
            $table->string('codigo_transacao')->unique();
            $table->foreignId('id_orcamento')
            ->constrained('orcamentos','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('id_funcionario')
            ->constrained('users','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
