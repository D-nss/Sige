<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoDataLocal extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_datas_locais';

    protected $dates = ['data_hora_inicio', 'data_hora_fim'];

    protected $fillable = [
        'acao_extensao_id',
        'data_hora_inicio',
        'data_hora_fim',
        'local',
        'complemento',
        'latitude',
        'longitude'
    ];

    public function acao_extensao()
    {
        return $this->belongsTo(AcaoExtensao::class);
    }
}
