<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Avaliador;
use App\Models\Criterio;
use App\Models\Cronograma;
use App\Models\Questao;

class Edital extends Model
{
    use HasFactory;

    protected $table = 'editais';

    protected $fillable = [
        'titulo',
        'tipo',
        'resumo',
        'total_recurso',
        'valor_max_inscricao',
        'anexo_edital',
        'anexo_imagem'
    ];

    public function criterios()
    {
        return $this->hasMany(Criterio::class);
    }

    public function cronogramas()
    {
        return $this->hasMany(Cronograma::class);
    }

    public function questoes()
    {
        return $this->hasMany(Questao::class);
    }

    public function avaliadores()
    {
        return $this->hasMany(Avaliador::class);
    }
}
