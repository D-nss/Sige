<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Inscricao;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    public function incricao()
    {
        return $this->hasMany(Inscricao::class);
    }
}
