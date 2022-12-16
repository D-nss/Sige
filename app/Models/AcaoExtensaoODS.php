<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoExtensaoODS extends Model
{
    use HasFactory;

    protected $table = 'acoes_extensao_ods';

    protected $fillable = [
        'acao_extensao_id',
        'objetivo_desenvolvimento_sustentavel_id'
    ];
}
