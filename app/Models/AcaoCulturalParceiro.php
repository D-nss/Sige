<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoCulturalParceiro extends Model
{
    use HasFactory;

    protected $table = 'acoes_culturais_parceiros';

    protected $fillable = [
        'acao_cultural_id',
        'nome',
        'tipo_parceiro_id'
    ];

    public function acao_cultural()
    {
        return $this->belongsTo(AcaoCultural::class);
    }

    public function tipo_parceiro()
    {
        return $this->belongsTo(TipoParceiro::class);
    }
}
