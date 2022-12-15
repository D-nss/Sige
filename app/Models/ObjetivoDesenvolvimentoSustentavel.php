<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoDesenvolvimentoSustentavel extends Model
{
    use HasFactory;

    protected $table = 'objetivos_desenvolvimento_sustentavel';

    protected $fillable = [
        'nome',
    ];
}
