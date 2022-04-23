<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Inscricao;

class Orcamento extends Model
{
    use HasFactory;

    protected $table = 'orcamento_itens';

    protected $fillable = [
        'inscricao_id',
        'tipo_item',
        'item',
        'descricao',
        'justificativa',
        'valor'
    ];

    public function inscricao()
    {
        $this->belongsTo(Inscricao::class);
    }
}
