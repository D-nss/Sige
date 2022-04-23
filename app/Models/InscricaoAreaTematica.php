<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscricaoAreaTematica extends Model
{
    use HasFactory;

    protected $table = 'inscricoes_areas_tematicas';

    protected $fillable = [
        'area_tematica_id',
        'incricao_id'
    ];
}
