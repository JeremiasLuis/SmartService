<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Taxa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'total'];
}
