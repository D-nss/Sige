<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoColaborador extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_colaboradores';

    protected $fillable = [
        'acao_extensao_id',
        'nome',
        'email',
        'documento',
        'numero_doc',
        'vinculo',
        'carga_horaria'
    ];

    public function acao_extensao()
    {
        return $this->belongsTo(AcaoExtensao::class);
    }
}
