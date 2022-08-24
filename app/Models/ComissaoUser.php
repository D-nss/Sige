<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comissao;
use App\Models\User;

class ComissaoUser extends Model
{
    use HasFactory;

    protected $table = 'comissoes_users';

    protected $fillable = [
        'comissao_id',
        'user_id',
    ];

    public function comissao()
    {
        return $this->belongsTo(Comissao::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

