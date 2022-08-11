<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comissao;
use App\Models\ComissaoUser;
use App\Models\Edital;
use App\Models\User;

class ComissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comissoes = Comissao::where('edital_id', $id)->get();
        $edital_titulo = Edital::where('id', $id)->get(['titulo']);
        $edital_id = $id;

        return view('comissoes.index', compact('comissoes', 'edital_titulo', 'edital_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $edital_titulo = Edital::where('id', $id)->get(['titulo']);
        $edital_id = $id;

        return view('comissoes.create', compact('edital_titulo', 'edital_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comissao = Comissao::create([
            'nome' => $request->nome,
            'atribuicao' => $request->atribuicao,
            'edital_id' => $request->edital_id,
        ]);

        if($comissao) {
            session()->flash('status', 'Comissão cadastrada com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to('/comissoes/edital/' . $request->edital_id);
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar comissão');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comissao $comissao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comissao $comissao)
    {
        if($comissao->delete()) {
            session()->flash('status', 'Comissão removida com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao remover comissão');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createParticipante($id)
    {
        $comissao = Comissao::find($id);
        $edital_id = $comissao->edital_id;
        $users = User::all();

        return view('comissoes.participantes', compact('comissao', 'edital_id', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function participanteStore(Request $request)
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
    public function participanteDelete(Request $request)
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
