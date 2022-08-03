<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Inscricao;

class LinhaExtensao extends Model
{
    use HasFactory;

    protected $table = 'linhas_extensao';

    public function inscricao()
    {
        return $this->hasOne(Inscricao::class);
    }
  
}
