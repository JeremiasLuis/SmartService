<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
   
    
    protected $fillable = [
        'imagem',
        'nome',
        'preco',
        'descricao'
    ];
}
