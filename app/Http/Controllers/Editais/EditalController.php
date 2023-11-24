<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

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
use App\Models\TipoPublico;
use App\Models\TipoEdital;

class EditalController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:edital-administrador|super')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $editais = Edital::all();
        $editais = $editais->sortByDesc('created_at');

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
        $tipos_publico = TipoPublico::all();
        $tipos_editais = TipoEdital::all();

        return view('edital.create', compact('tipos_publico', 'tipos_editais'));
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
                $validar[$key] = 'required|file|max:5120|mimes:pdf';
            }
            elseif($key == 'anexo_imagem') {
                $validar[$key] = 'file|max:5120|mimes:png';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $validar['publicos_alvo'] = 'required';

        $validated = $request->validate($validar);

        $uploaded = new UploadFile();

        $edital = Edital::create([
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'resumo' => $request->resumo,
            'total_recurso' => str_replace(',', '.', str_replace('.', '',$request->total_recurso)),
            'valor_max_inscricao' => str_replace(',', '.', str_replace('.', '',$request->valor_max_inscricao)),
            'valor_max_programa' => empty($request->valor_max_programa) ? 0.00 : str_replace(',', '.', str_replace('.', '',$request->valor_max_programa)),
            'anexo_edital' => $uploaded->execute($request, 'anexo_edital', 'pdf', 5000000), //chama o função execute da model UploadFile e faz o upload do arquivo
            'anexo_imagem' => !!$request->anexo_imagem ? $uploaded->execute($request, 'anexo_imagem', 'png', 5000000) : '',
        ]);

        $publicos = [];
        foreach($request->publicos_alvo as $publico) {
            array_push($publicos, [
                'tipo_publico_id' => $publico,
                'edital_id'       => $edital->id,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ]);
        }

        DB::table('publicos_alvo')->insert($publicos);

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
        $tipos_publico = TipoPublico::all();
        $tipos_editais = TipoEdital::all();

        return view('edital.edit', compact('edital', 'tipos_publico', 'tipos_editais'));
        
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
                $validar[$key] = 'file|max:5120|mimes:pdf';
            }
            elseif($key == 'anexo_imagem') {
                $validar[$key] = 'file|max:5120|mimes:png';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $validar['publicos_alvo'] = 'required';

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

        DB::table('publicos_alvo')->where('edital_id', $edital->id)->delete();

        $publicos = [];
        foreach($request->publicos_alvo as $publico) {
            array_push($publicos, [
                'tipo_publico_id' => $publico,
                'edital_id'       => $edital->id,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ]);
        }

        DB::table('publicos_alvo')->insert($publicos);

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
