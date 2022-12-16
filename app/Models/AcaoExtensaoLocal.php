<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoLocal extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_locais';

    protected $fillable = [
        'acao_extensao_id',
        'local',
        'complemento',
        'latitude',
        'longitude'
    ];
}
