<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestaoRespondida extends Model
{
    use HasFactory;

    protected $table = 'questoes_respondidas';

    protected $fillable = [
        'resposta',
        'questao_id',
        'inscricao_id'
    ];

}
