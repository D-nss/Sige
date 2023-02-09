<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ModeloCertificado;
use App\Models\User;
use App\Models\Comissao;

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
        'ck_arquivo',
        'carga_horaria',
        'doc_certificado',
        'grupo_usuario',
        'user_id',
        'modelo_certificado_id',
        'status',
        'prazo_envio_arquivo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modelo_certificado()
    {
        return $this->belongsTo(ModeloCertificado::class);
    }

    public function inscritos()
    {
        return $this->hasMany(EventoInscrito::class);
    }

    public function comissoes()
    {
        return $this->hasMany(Comissao::class, 'evento_id');
    }

}
