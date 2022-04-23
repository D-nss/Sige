<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostasAvaliacoes extends Model
{
    use HasFactory;

    protected $table = 'respostas_avaliacoes';

    protected $fillable = [
        'user_id',
        'inscricao_id',
        'questao_id',
        'valor'
    ];
}
