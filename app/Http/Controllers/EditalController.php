<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Avaliador;
use App\Models\AreaTematica;
use App\Models\Cronograma;
use App\Models\Comissao;
use App\Models\Edital;
use App\Models\UploadFile;
use App\Models\User;
use App\Models\SubcomissaoTematica;
use App\Models\Inscricao;
use App\Models\RespostasAvaliacoes;

class EditalController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-administrador|super')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::where('email', Auth::user()->id)->first();

        $editais = Edital::all();

        $inscricoes = Inscricao::where('user_id', $user->id)->get();

        $comissoes = Comissao::join('comissoes_users', 'comissoes_users.comissao_id', 'comissoes.id')
                            ->where('comissoes_users.user_id', $user->id)
                            ->get();

        $cronograma = new Cronograma();

        $editais = $editais->filter(function($value, $key) {
            return data_get($value, 'status') != null;
        });

        return view('edital.index2', compact('user', 'editais', 'cronograma', 'inscricoes', 'comissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('edital.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $inputsParaValidar = $request->except(['valor_max_programa']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:1000';
            }
            elseif($key == 'anexo_edital') {
                $validar[$key] = 'required|mimes:pdf';
            }
            elseif($key == 'anexo_imagem') {
                $validar[$key] = 'mimes:png';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $validated = $request->validate($validar);

        $uploaded = new UploadFile();

        $edital = Edital::create([
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'resumo' => $request->resumo,
            'total_recurso' => str_replace(',', '.', str_replace('.', '',$request->total_recurso)),
            'valor_max_inscricao' => str_replace(',', '.', str_replace('.', '',$request->valor_max_inscricao)),
            'valor_max_programa' => empty($request->valor_max_programa) ? 0.00 : str_replace(',', '.', str_replace('.', '',$request->valor_max_programa)),
            'anexo_edital' => $uploaded->execute($request, 'anexo_edital', 'pdf', 3000000), //chama o função execute da model UploadFile e faz o upload do arquivo
            'anexo_imagem' => !!$request->anexo_imagem ? $uploaded->execute($request, 'anexo_imagem', 'png', 3000000) : '',
        ]);

        if($edital) {

            session()->flash('status', 'Edital cadastrado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/$edital->id/criterios");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param   App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function show(Edital $edital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function edit(Edital $edital)
    {
        
        return view('edital.edit', compact('edital'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Edital $edital)
    {
        $inputsParaValidar = $request->except(['valor_max_programa']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:1000';
            }
            elseif($key == 'anexo_edital') {
                $validar[$key] = 'mimes:pdf';
            }
            elseif($key == 'anexo_imagem') {
                $validar[$key] = 'mimes:png';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $validated = $request->validate($validar);

        $uploaded = new UploadFile();

        $editalUpdated = Edital::where('id', $edital->id)
                        ->update([
                            'titulo' => $request->titulo,
                            'tipo' => $request->tipo,
                            'resumo' => $request->resumo,
                            'total_recurso' => str_replace(',', '.', str_replace('.', '',$request->total_recurso)),
                            'valor_max_inscricao' => str_replace(',', '.', str_replace('.', '',$request->valor_max_inscricao)),
                            'valor_max_programa' => empty($request->valor_max_programa) ? 0.00 : str_replace(',', '.', str_replace('.', '',$request->valor_max_programa)),
                            'anexo_edital' => !!$request->anexo_edital ? $uploaded->execute($request, 'anexo_edital', 'pdf', 3000000) : $edital->anexo_edital,
                            'anexo_imagem' => !!$request->anexo_imagem ? $uploaded->execute($request, 'anexo_imagem', 'png', 3000000) : $edital->anexo_imagem,
                        ]);

        if($editalUpdated) {

            session()->flash('status', 'Edital Atualizado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("processo-editais/$edital->id/editar");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Edital $edital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function divulgar(Edital $edital)
    {
        //$edital = Edital::findOrFail($id);
        $edital->status = 'Divulgação';

        if( $edital->update() ) {

            session()->flash('status', 'Edital Divulgado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("processo-editais");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao divulgar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

        /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function classificar(Request $request, Edital $edital)
    {
        $inscricoes = Inscricao::where('edital_id', $edital->id)->where('status', 'Avaliado')->get();

        foreach($inscricoes as $inscricao) {
            $countAvaliadores = $inscricao->avaliadores->count();

            $somaNota = RespostasAvaliacoes::where('inscricao_id', $inscricao->id)->sum('valor');
            
            $notaFinal = $somaNota / $countAvaliadores;

            $inscricao->nota = $request->forma_avaliacao == 'media' ? $notaFinal : $somaNota;

            $inscricao->save();


        }

        $inscricoes = Inscricao::where('edital_id', $edital->id)->where('nota', '<>', null)->orderby('nota', 'desc')->get();

        return view('inscricao.classificacao', compact('edital', 'inscricoes'));
    }

    
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function listarClassificados(Request $request, Edital $edital)
    {

        $inscricoes = Inscricao::where('edital_id', $edital->id)->where('nota', '<>', null)->orderby('nota', 'desc')->get();

        return view('inscricao.classificacao', compact('edital', 'inscricoes'));
    }
}
