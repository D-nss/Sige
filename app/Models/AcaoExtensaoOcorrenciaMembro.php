<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoOcorrenciaMembro extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_ocorrencias_membros';

    protected $fillable = [
        'nome',
        'email',
        'instituicao',
        'cpf',
        'vinculo',
        'whatsapp',
        'funcao',
        'carga_horaria',
        'funcionario_unicamp',
        'aluno_unicamp',
        'user_id',
        'acao_extensao_ocorrencia_id',
        //'certificado'
    ];

    public function ocorrencia()
    {
        return $this->belongsTo(AcaoExtensaoOcorrencia::class);
    }
}
