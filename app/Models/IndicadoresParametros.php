<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadoresParametros extends Model
{
    use HasFactory;

    protected $table = 'indicadores_parametros';

    protected $fillable = [
        'ano_base',
        'data_limite'
    ];

}
