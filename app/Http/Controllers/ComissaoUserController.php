<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comissao;
use App\Models\ComissaoUser;
use App\Models\User;

class ComissaoUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-analista|edital-administrador|super');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $comissao = Comissao::find($id);
        $edital_id = $comissao->edital_id;
        $users = User::join('unidades', 'users.unidade_id', 'unidades.id')
                        ->orderBy('name', 'asc')
                        ->get(['users.*', 'unidades.sigla']);

        return view('comissoes.participantes', compact('comissao', 'edital_id', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comissao_user_exist = ComissaoUser::where('comissao_id', $request->comissao_id)->where('user_id', $request->user_id)->get()->toArray();
        
        if(!empty($comissao_user_exist)) {
            session()->flash('status', 'Desculpe! Usuário ja cadastrado na comissão');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $comissao = ComissaoUser::create([
            'user_id' => $request->user_id,
            'comissao_id' => $request->comissao_id,
        ]);

        if($comissao) {
            $comissao->user->notify(new \App\Notifications\ComissaoUserAdicionado($comissao));
            session()->flash('status', 'Participante de comissão cadastrado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to('/comissoes/edital/' . $request->edital_id);
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar participante na comissão');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comissao_user_deleted = ComissaoUser::where('comissao_id', $request->comissao_id)->where('user_id', $request->user_id)->delete();
        
        if(!!$comissao_user_deleted) {
            session()->flash('status', 'Participante de comissão removido com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao remover participante na comissão');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
