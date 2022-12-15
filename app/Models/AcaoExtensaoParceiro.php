<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoParceiro extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_parceiros';

    protected $fillable = [
        'acao_extensao_id',
        'nome',
        'tipo_parceiro_id',
        'colaboracao'
    ];

    public function acao_extensao()
    {
        return $this->belongsTo(AcaoExtensao::class);
    }

    public function tipo_parceiro()
    {
        return $this->belongsTo(TipoParceiro::class);
    }
}
