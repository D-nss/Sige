<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoAreaTematica extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_areas_tematicas';

    protected $fillable = [
        'acao_extensao_id',
        'area_tematica_id'
    ];
}
