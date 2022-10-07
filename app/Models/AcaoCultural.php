<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoCultural extends Model
{
    use HasFactory;

    protected $table = 'acoes_culturais';

    protected $fillable = [
        'titulo',
        'resumo',
        'segmento_cultural', //listar segmentos
        'nome_coordenador',
        'email_coordenador',
        'vinculo_coordenador', //saber tipos ?? quando coordenador não seja unicamp
        'palavras_chaves',
        'url',
        'vinculo_ensino',
        'vinculo_pesquisa',
        'vinculo_extensao',
        'publico_alvo', //trazer caixa multipla seleção
        'tipo_evento', // multipla = online; presencial; híbrido
        'gratuito',
        'estimativa_publico',
        'municipio_id',
        'georreferenciacao',
        'user_id',
        'unidade_id',
        'financiamento',
        'status'
    ];

    public function user() //Caso possui vinculo unicamp
    {
        return $this->belongsTo(User::class);
    }

    public function unidade() //Caso possui vinculo unicamp
    {
        return $this->belongsTo(Unidade::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function aprovado()
    {
        return $this->belongsTo(User::class, 'aprovado_user_id');
    }

    public function unidades_envolvidas()
    {
        return $this->belongsToMany(Unidade::class, 'acoes_culturais_unidades', 'acao_cultural_id', 'unidade_id' );
    }
}
