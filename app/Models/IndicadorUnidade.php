<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorUnidade extends Model
{
    use HasFactory;

    protected $table = 'indicadores_unidades';

    protected $fillable = [
        'indicador_id',
        'valor',
        'unidade_id',
        'ano_base'
    ];

    public function indicador(){
        return $this->hasMany(Indicador::class, 'id');
    }

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }
}
