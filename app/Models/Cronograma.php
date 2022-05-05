<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    use HasFactory;

    protected $table = 'cronogramas';

    protected $fillable = [
        'dt_input',
        'data',
        'edital_id'
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }

    public function getDate($dt_input, $edital_id)
    {
        $cronograma = Cronograma::where('dt_input', $dt_input)->where('edital_id', $edital_id)->get(['data']);
        return $cronograma[0]->data;
    }
}
