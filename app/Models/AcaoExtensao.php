<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensao extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao';
    protected $dates = ['data_inicio', 'data_fim'];

    protected $fillable = [
        'modalidade',
        'linha_extensao_id',
        'titulo',
        'descricao',
        'palavras_chaves',
        'url',
        'publico_alvo',
        'estimativa_publico',
        'data_inicio',
        'data_fim',
        'situacao',
        'municipio_id',
        'user_id',
        'unidade_id',
        'nome_coordenador',
        'email_coordenador',
        'vinculo_coordenador',
        'vagas_curricularizacao',
        'parceiro',
        'tipo_parceiro_id',
        'impactos_universidade',
        'impactos_sociedade',
        'grau_envolvimento_equipe_id',
        'investimento',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
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
}
