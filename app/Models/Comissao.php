<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comissao;

class Comissao extends Model
{
    use HasFactory;

    protected $table = 'comissoes';

    protected $fillable = [
        'nome',
        'atribuicao',
        'edital_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'comissoes_users');
    }
    
    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }
}