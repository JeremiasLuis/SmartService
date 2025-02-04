<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viatura extends Model
{

    protected $fillable = [
        'matricula',
        'marca',
        'modelo',
        'cor',
        'tipo',
        'estado',
        'tipo_avaria',
        'codigo_validacao',
        'id_cliente'
    ];
}
