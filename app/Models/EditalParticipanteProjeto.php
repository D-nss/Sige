<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditalParticipanteProjeto extends Model
{
    use HasFactory;

    protected $table = 'editais_participantes_projeto';
    protected $fillable = [
        'nome',
        'categoria',
        'ra',
        'unidade',
        'instituicao',
        'carga_semanal',
        'carga_total',
        'inscricao_id'
    ];
}
