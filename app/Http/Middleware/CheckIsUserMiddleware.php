<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Unidade;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user = User::where('email', Auth::user()->id)->first();

        //Usuário não encontrado
        if (!$user){

            //Consulta Unidade pela sigla retornado pelo Keycloak
            $unidade = Unidade::where(DB::raw('lower(sigla)'), 'like', strtolower(Auth::user()->unidade))->first();
            $nome = implode(' ',array_unique(explode(' ', Auth::user()->name)));

            if($unidade){
                $user = User::create([
                    'name' => $nome,
                    'email' => Auth::user()->id,
                    'unidade_id' => $unidade->id,
                    'codigoUnidade' => Auth::user()->codigoUnidade,
                    'ativo' => true,
                ]);

            session()->flash('success', 'Olá '.$user->name.'! Você foi cadastrado no sistema. Agora acesse o menu para realizar as operações desejadas');

            } else {
                //Gerar log do acesso barrado devido ao não retorno da unidade do usuário autenticado no SiSe
                session()->flash('danger', 'Olá '.$nome.'! Unidade não encontrada, entre em contato com Administrador do sistema para utilização');
                return redirect('/');
            }

            if (Auth::user()->employeetype == 'PROFESSOR/PESQUISADOR VISITANTE' || Auth::user()->employeetype == 'Funcionário UNICAMP'){
                $user->assignRole('edital-coordenador');
                //para teste:
                //$user->assignRole('admin');
                //$user->assignRole('super');
                //$user->assignRole('indicadores-user');
            }
        }

        $user->updated_at = now();
        $user->save();
        
        Auth::guard('web_user')->login($user);
        //Auth::setUser($user);

        return $next($request);
    }
}
