<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoCulturalDataLocal extends Model
{
    use HasFactory;

    protected $table = 'acoes_culturais_datas_locais';
    protected $dates = ['data', 'hora_inicio', 'hora_fim'];

    protected $fillable = [
        'acao_cultural_id',
        'data',
        'hora_inicio',
        'hora_fim',
        'local'
    ];

    public function acao_cultural()
    {
        return $this->belongsTo(AcaoCultural::class);
    }
}
