<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxaRegistrada extends Model
{
    protected $table = 'taxas_registradas';
    
    protected $fillable = ['id_taxa', 'id_servicos'];
}
