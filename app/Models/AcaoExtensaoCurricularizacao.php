<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoCurricularizacao extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_curricularizacao';

    protected $fillable = [
        'acao_extensao_ocorrencia_id',
        'aluno_ra',
        'status',
        'apto',
    ];

    public function acao_extensao_ocorrencia()
    {
        return $this->belongsTo(AcaoExtensaoOcorrencia::class);
    }
}
