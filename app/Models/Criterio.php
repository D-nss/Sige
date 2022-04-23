<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Edital;

class Criterio extends Model
{
    use HasFactory;

    protected $table = 'criterios';

    protected $fillable = [
        'descricao',
        'edital_id'
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }
}
