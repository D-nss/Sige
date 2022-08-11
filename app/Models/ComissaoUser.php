<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComissaoUser extends Model
{
    use HasFactory;

    protected $table = 'comissoes_users';

    protected $fillable = [
        'comissao_id',
        'user_id',
    ];

}
