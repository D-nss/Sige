<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Edital;
use App\Models\User;

class Avaliador extends Model
{
    use HasFactory;

    protected $table = 'avaliadores';

    protected $fillable = [
        'user_id',
        'edital_id',
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
