<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriaoEditalOds extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscricao_id',
        'objetivo_desenvolvimento_sustentavel_id'
    ];
}
