<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('taxas_registradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_taxa')
            ->constrained('taxas','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('id_servicos')
            ->constrained('servicos','id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxas_registradas');
    }
};
