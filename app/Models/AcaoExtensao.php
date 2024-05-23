<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensao extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao';

    protected $fillable = [
        'modalidade',
        'linha_extensao_id',
        'titulo',
        'descricao',
        'palavras_chaves',
        'url',
        'publico_alvo',
        'estimativa_publico',
        'situacao',
        'municipio_id',
        'user_id',
        'unidade_id',
        'nome_coordenador',
        'email_coordenador',
        'vinculo_coordenador',
        'vagas_curricularizacao',
        'qtd_horas_curricularizacao',
        'parceiro',
        'tipo_parceiro_id',
        'impactos_universidade',
        'impactos_sociedade',
        'grau_envolvimento_equipe_id',
        'status',
        'arquivo',
        'programa_id',
        'anotacoes',
        'mensagem_extensao'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comite_user()
    {
        return $this->belongsTo(User::class, 'comite_user_id', 'id');
    }

    public function graduacao_user()
    {
        return $this->belongsTo(User::class, 'comissao_graduacao_user_id', 'id');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function unidades_envolvidas()
    {
        return $this->belongsToMany(Unidade::class, 'acoes_extensao_unidades', 'acao_extensao_id', 'unidade_id' );
    }

    public function linha_extensao()
    {
        return $this->belongsTo(LinhaExtensao::class);
    }

    public function areas_tematicas()
    {
        return $this->belongsToMany(AreaTematica::class, 'acoes_extensao_areas_tematicas', 'acao_extensao_id', 'area_tematica_id' );
    }

    public function objetivos_desenvolvimento_sustentavel()
    {
        return $this->belongsToMany(ObjetivoDesenvolvimentoSustentavel::class, 'acoes_extensao_ods', 'acao_extensao_id', 'objetivo_desenvolvimento_sustentavel_id' );
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function tipo_parceiro()
    {
        return $this->belongsTo(TipoParceiro::class);
    }

    public function grau_envolvimento_equipe()
    {
        return $this->belongsTo(GrauEnvolvimentoEquipe::class);
    }

    public function aprovado()
    {
        return $this->belongsTo(User::class, 'aprovado_user_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function analista_conext()
    {
        return $this->belongsTo(User::class, 'avaliacao_conext_user_id');
    }

    public function ocorrencia()
    {
        return $this->hasMany(AcaoExtensaoOcorrencia::class);
    }

    public function programa()
    {
        return $this->hasOne(AcaoExtensao::class, 'id', 'programa_id');
    }
}
