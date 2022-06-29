<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensao extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao';

    protected $fillable = [
        'tipo',
        'linha_extensao_id',
        'areas_tematicas',
        'titulo',
        'descricao',
        'palavras_chaves',
        'url',
        'publico_alvo',
        'data_inicio',
        'data_fim',
        'situacao',
        'municipio_id',
        'georreferenciacao',
        'user_id',
        'unidade_id',
        'nome_coordenador',
        'tipo_coordenador',
        'equipe',
        'qtd_graduacao',
        'qtd_pos_graduacao',
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

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function aprovado()
    {
        return $this->belongsTo(User::class, 'aprovado_user_id');
    }
}
