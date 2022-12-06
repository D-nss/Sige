<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\Evento;

class EventoInscrito extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'tipo_documento',
        'documento',
        'instituicao',
        'pais',
        'area',
        'vinculo',
        'nascimento',
        'sexo',
        'genero',
        'funcao',
        'municipio',
        'arquivo',
        'certificado',
        'certificado_enviado',
        'evento_id',
        'presenca',
        'confirmacao',
        'data_confirmacao',
        'personalizado',
        'lista_espera',
        'posicao_espera',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
