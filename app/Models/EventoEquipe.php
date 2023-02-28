<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoEquipe extends Model
{
    use HasFactory;

    protected $table = 'evento_equipe';

    protected $fillable = [
        'nome',
        'email',
        'instituicao',
        'cpf',
        'whatsapp',
        'funcao_evento',
        'funcionario_unicamp',
        'aluno_unicamp',
        'user_id',
        'evento_id'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
