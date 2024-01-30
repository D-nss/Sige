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
        'unidade_id',
        'user_id',
        'carta_apresentacao',
        'justificativa',
    ];

    public function acao_extensao_ocorrencia()
    {
        return $this->belongsTo(AcaoExtensaoOcorrencia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aluno()
    {
        return $this->hasOne(Dbsig::class, 'NREGALUN', 'aluno_ra');
    }
}
