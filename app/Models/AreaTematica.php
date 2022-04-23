<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Inscricao;

class AreaTematica extends Model
{
    use HasFactory;

    protected $table = 'areas_tematicas';

    protected $fillable = [
        'nome',
    ];

    public function inscricoes()
    {
        return $this->belongsToMany(Inscricao::class);
    }
}
