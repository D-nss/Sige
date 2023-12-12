<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function index()
    {
        if(App::environment('local')){
            $user = User::where('id',3)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if($user->hasRole('edital-administrador')) {
            $comissoes = Comissao::where('edital_id', '<>' , null)->get();
        }
        
        if($user->hasRole('extensao-coordenador')){
            $comissoes = Comissao::where('unidade_id', $user->unidade->id)->get();
        }

        if($user->hasAnyRole('super|admin')) {
            $comissoes = Comissao::all();
        }

        return view('comissoes.index', compact('comissoes', 'user'));
    }

     /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $comissoesTodas = Comissao::all();
        
        if($user->hasRole('edital-administrador')) {
            $comissoes = $comissoesTodas->where('edital_id', '<>' , null)->filter(function($item) use ($request) {
                return false !== stristr($item->nome, $request->palavra);
            });
        }
        
        if($user->hasRole('extensao-coordenador')){
            $comissoes = $comissoesTodas->where('unidade_id', $user->unidade->id)->filter(function($item) use ($request) {
                return false !== stristr($item->nome, $request->palavra);
            });
        }

        if($user->hasAnyRole('super|admin')) {
            $comissoes = $comissoesTodas->filter(function($item) use ($request) {
                return false !== stristr($item->nome, $request->palavra);
            });
        }

        //echo json_encode($comissoes);
        return view('comissoes.index', compact('comissoes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }
        //echo json_encode($edital_id);
        $editais = Edital::all();

        return view('comissoes.create', compact('editais', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = isset($request->evento_id) ? $request->evento_id : null;
        //echo json_encode($request->all());
        $validated = $request->validate(
            [
                'nome' => 'required|max:190',
                'atribuicao' => 'required|max:190',
                'edital_id' => is_null($request->unidade_id) && is_null($evento) ? 'required' : '',
            ],
            [
                'edital_id.required' => 'O campo edital é obrigatório.',
                'atribuicao.required' => 'O campo atribuição é obrigatório.',
            ]
        );

        if($request->atribuicao == 'Extensão') {
            $comissao_ext_unidade = Comissao::where('unidade_id', is_null($request->unidade_id) ? '' : $request->unidade_id)
                                            ->where('atribuicao', 'Extensão')
                                            ->first();

            if( $comissao_ext_unidade && !is_null($request->unidade_id) ) {
                session()->flash('status', 'A unidade já possui uma comissão de extensão cadastrada!!!');
                session()->flash('alert', 'warning');
    
                return redirect()->to('/comissoes');
            }
        }

        if($request->atribuicao == 'Graduação') {
            $comissao_grd_unidade = Comissao::where('unidade_id', is_null($request->unidade_id) ? '' : $request->unidade_id)
                                            ->where('atribuicao', 'Graduação')
                                            ->first();

            if( $comissao_grd_unidade && !is_null($request->unidade_id) ) {
                session()->flash('status', 'A unidade já possui uma comissão de graduação cadastrada!!!');
                session()->flash('alert', 'warning');

                return redirect()->to('/comissoes');
            }
        }

        $comissao = Comissao::create(
            [
                'nome' => $request->nome,
                'atribuicao'    => $request->atribuicao,
                'edital_id'     => $request->edital_id,
                'unidade_id'    => $request->unidade_id,
                'evento_id'     => $request->evento_id,
            ]
        );

        if($comissao) {
            Log::channel('comissoes')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Comissão cadastrada ID:'. $comissao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Comissão cadastrada com sucesso!!!');
            session()->flash('alert', 'success');

            if(!is_null($comissao->evento_id)) {
                return redirect()->back();
            }
            
            return redirect()->to('/comissoes');
        }
        else {
            Log::channel('comissoes')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Comissão não cadastrada ID:'. $comissao->id .'  - Endereço IP: ' . $request->ip());
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
        $comissao_user_deleted = ComissaoUser::where('comissao_id', $comissao->id)->delete();

        if($comissao->delete()) {
            Log::channel('comissoes')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Comissão removida ID:'. $comissao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Comissão removida com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('comissoes')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Comissão não removida ID:'. $comissao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao remover comissão');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }


}
