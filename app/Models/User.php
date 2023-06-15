<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Avaliador;
use App\Models\Inscricao;
use App\Models\Comissao;
use App\Models\AvaliadorPorInscricao;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    //teste
    protected $guard_name = 'web_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'unidade_id',
        'ativo',
        'codigoUnidade'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

    public function avaliador(){
        return $this->belongsTo(Avaliador::class);
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class);
    }

    public function comissoes()
    {
        return $this->hasMany(ComissaoUser::class);
    }

    public function checaAvaliadorExistenteEmEdital($edital_id, $user_id)
    {
        $avaliadorExiste = AvaliadorPorInscricao::select('avaliadores_por_inscricao.*')
                                                ->join('inscricoes', 'inscricoes.id', 'avaliadores_por_inscricao.inscricao_id')
                                                ->join('editais', 'inscricoes.edital_id', 'editais.id')
                                                ->where('avaliadores_por_inscricao.user_id', $user_id)
                                                ->where('editais.id', $edital_id)
                                                ->first();

        if($avaliadorExiste) {
            return true;
        }
        else {
            return false;
        }
        
    }

}
