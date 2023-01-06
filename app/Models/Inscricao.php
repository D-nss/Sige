<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Orcamento;
use App\Models\User;
use App\Models\Municipio;
use App\Models\AreaTematica;
use App\Models\RespostasAvaliacoes;
use App\Models\Recurso;
use App\Models\Comentario;
use App\Models\SucomissaoTematica;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = "inscricoes";

    protected $fillable = [
        'titulo',
        'tipo',
        'municipio_id',
        'resumo',
        'palavras_chaves',
        'parceria',
        'anexo_parceria',
        'anexo_projeto',
        'url_projeto',
        'url_lattes',
        'status',
        'justificativa',
        'linha_extensao_id',
        'user_id',
        'unidade_id',
        'avaliador_user_id',
        'edital_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function orcamento()
    {
        return $this->hasMany(Orcamento::class);
    }

    public function areas()
    {
        return $this->belongsToMany(AreaTematica::class, 'inscricoes_areas_tematicas', 'inscricao_id', 'area_tematica_id' );
    }

    public function avaliadores()
    {
        return $this->belongsToMany(User::class, 'avaliadores_por_inscricao', 'inscricao_id', 'user_id' );
    }

    public function respostas_avaliacoes()
    {
        return $this->belongsToMany(User::class, 'respostas_avaliacoes', 'inscricao_id', 'user_id');
    }

    public function subcomissao()
    {
        return $this->belongsToMany(SubcomissaoTematica::class, 'unidades', 'subcomissao_tematica_id', 'id');
    }

    public function pareceres()
    {
        return $this->hasMany(Parecer::class);
    }

    public function analista()
    {
        return $this->belongsTo(User::class, 'analista_user_id');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function linha_extensao()
    {
        return $this->belongsTo(LinhaExtensao::class);
    }

    
    public function recurso()
    {
        return $this->hasOne(Recurso::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

}
