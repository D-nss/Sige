<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comissao;
use App\Models\ComissaoUser;
use App\Models\Edital;
use App\Models\User;

class ComissaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-analista|edital-administrador|super');
    }

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

}
