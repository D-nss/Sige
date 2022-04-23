<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Edital;

class Questao extends Model
{
    use HasFactory;

    protected $table = 'questoes';

    protected $fillable = [
        'tipo',
        'enunciado',
        'edital_id',
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }
}
