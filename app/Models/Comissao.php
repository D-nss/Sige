<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comissao;
use App\Models\Evento;
use App\Models\Unidade;

class Comissao extends Model
{
    use HasFactory;

    protected $table = 'comissoes';

    protected $fillable = [
        'nome',
        'atribuicao',
        'edital_id',
        'unidade_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'comissoes_users');
    }
    
    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}