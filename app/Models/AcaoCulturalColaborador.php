<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoCulturalColaborador extends Model
{
    use HasFactory;

    protected $table = 'acoes_culturais_colaboradores';

    protected $fillable = [
        'acao_cultural_id',
        'nome',
        'email',
        'cpf',
        'vinculo'
    ];

    public function acao_cultural()
    {
        return $this->belongsTo(AcaoCultural::class);
    }
}
