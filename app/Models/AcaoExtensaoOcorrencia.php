<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoOcorrencia extends Model
{
    use HasFactory;

    protected $table = 'acao_extensao_ocorrencias';

    protected $dates = ['data_hora_inicio', 'data_hora_fim'];

    protected $fillable = [
        'acao_extensao_id',
        'data_hora_inicio',
        'data_hora_fim',
        'local',
        'complemento',
        'latitude',
        'longitude',
        'inicio_inscricoes',
        'fim_inscricoes'
    ];

    public function acao_extensao()
    {
        return $this->belongsTo(AcaoExtensao::class);
    }

    public function curricularizacao() 
    {
        return $this->hasMany(AcaoExtensaoCurricularizacao::class, 'acao_extensao_ocorrencia_id');
    }
}
