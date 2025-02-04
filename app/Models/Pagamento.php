<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{

    protected $fillable = [
        'metodo',
        'parcelar',
        'valor',
        'status',
        'observacao',
        'codigo_transacao',
        'id_funcionario',
        'id_orcamento'

    ];
 
}
