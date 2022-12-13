<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Certificado;
use App\Models\User;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'local',
        'gratuito',
        'online',
        'hibrido',
        'data_inicio',
        'data_fim',
        'detalhes',
        'inscricao',
        'inscricao_inicio',
        'inscricao_fim',
        'vagas',
        'ck_documento',
        'ck_sexo',
        'ck_identidade_genero',
        'ck_nascimento',
        'ck_instituicao',
        'ck_vinculo',
        'ck_area',
        'ck_funcao',
        'ck_pais',
        'ck_cidade_estado',
        'carga_horaria',
        'doc_certificado',
        'grupo_usuario',
        'user_id',
        'modelo_certificado_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modelo_certificado()
    {
        return $this->belongsTo(Certificado::class);
    }
}
