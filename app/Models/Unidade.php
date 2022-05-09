<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    public function usuarios(){
        return $this->hasMany(User::class);
    }
    public function subcomissao(){
        return $this->belongsTo(SubcomissaoTematica::class);
    }
}
