<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Unidade;

class SubcomissaoTematica extends Model
{
    use HasFactory;

    protected $table = 'subcomissao_tematica';

    protected $fillable = [
        'nome'
    ];

    public function unidades()
    {
        return $this->hasMany(Unidade::class);
    }
}
