<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Orcamento;
use App\Models\User;

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

}
