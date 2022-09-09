<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parecer extends Model
{
    use HasFactory;

    protected $table = 'pareceres';

    protected $fillable = [
        'inscricao_id',
        'user_id',
        'justificativa',
        'parecer'
    ];
}
