<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Unidade;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Vizir\KeycloakWebGuard\Facades\KeycloakWeb;

class CheckIsUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Usuário do autenticado no SiSe no sistema
        //$user = User::where('email', Auth::user()->id)->first();
        $user = User::where('uid', Auth::user()->id)->first(); //para que se possa alterar a coluna de email para ambiente de desenvolvimento e teste

        //Usuário não encontrado
        if (!$user){

            if(Auth::user()->employeetype == "Aluno UNICAMP") {
                $unidade = Unidade::where('sigla', 'ALUNO')->first();
            }else {
                //Consulta Unidade pela sigla retornado pelo Keycloak
                $unidade = Unidade::where(DB::raw('lower(sigla)'), 'like', strtolower(Auth::user()->unidade))->first();
            }

            $nome = implode(' ',array_unique(explode(' ', Auth::user()->name)));

            if($unidade){
                $user = User::create([
                    'name' => $nome,
                    'uid' => Auth::user()->id,
                    'email' => Auth::user()->id,
                    'unidade_id' => $unidade->id,
                    'codigoUnidade' => Auth::user()->codigoUnidade,
                    'ativo' => true,
                ]);

                session()->flash('status', 'Olá '.$user->name.'! Você foi cadastrado no sistema. Agora acesse o menu para realizar as operações desejadas');
                session()->flash('alert', 'success');

                return redirect()->to('/');

            } else {
                //Gerar log do acesso barrado devido ao não retorno da unidade do usuário autenticado no SiSe
                session()->flash('status', 'Olá '.$nome.'! Unidade não encontrada, entre em contato com Administrador do sistema para utilização');
                session()->flash('alert', 'warning');

                return redirect()->to('/');
            }

            if (Auth::user()->employeetype == 'PROFESSOR/PESQUISADOR VISITANTE' || Auth::user()->employeetype == 'Funcionário UNICAMP'){
                $user->assignRole('edital-coordenador');
                $user->assignRole('acoes');
                //para teste:
                //$user->assignRole('admin');
                //$user->assignRole('super');
                //$user->assignRole('indicadores-user');
            }
        }

        if( !$user->hasRole(['edital-coordenador', 'acoes']) && (Auth::user()->employeetype == 'PROFESSOR/PESQUISADOR VISITANTE' || Auth::user()->employeetype == 'Funcionário UNICAMP') ) {
            $user->assignRole('edital-coordenador');
            $user->assignRole('acoes');
        }

        $user->updated_at = now();
        $user->save();

        Auth::guard('web_user')->login($user);
        //Auth::setUser($user);


        return $next($request);
    }
}
