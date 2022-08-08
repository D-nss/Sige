<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Avaliador;
use App\Models\AreaTematica;
use App\Models\Edital;
use App\Models\UploadFile;
use App\Models\User;
use App\Models\SubcomissaoTematica;

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

        $editais = Edital::all();

        $editais = $editais->filter(function($value, $key) {
            return data_get($value, 'status') != null;
        });

        return view('edital.index2', compact('editais'));
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
            'valor_max_programa' => str_replace(',', '.', str_replace('.', '',$request->valor_max_programa)),
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
                            'valor_max_programa' => $request->valor_max_programa == '' || $request->valor_max_programa == null ? NULL : str_replace(',', '.', str_replace('.', '',$request->valor_max_programa)),
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

    public function editarCriterios(Edital $edital)
    {
        $criterios = $edital->criterios;

        return view('criterios.create', compact('edital', 'criterios'));
    }

    public function editarCronograma(Edital $edital)
    {
        $modelo_cronograma = DB::table('modelo_cronograma')->where('tipo_edital', $edital->tipo)->get();

        return view('cronograma.create', compact('edital', 'modelo_cronograma'));
    }

    public function editarQuestoes(Edital $edital)
    {
        return view('questoes.create', compact('edital'));
    }

    public function editarAvaliadores(Edital $edital)
    {
        $users = User::all();
        $subcomissoes = SubcomissaoTematica::all();
        $avaliadores = Avaliador::join('users', 'users.id', 'avaliadores.user_id')
                                ->join('unidades', 'users.unidade_id', 'unidades.id')
                                ->where('avaliadores.edital_id', $edital->id)
                                ->get(['avaliadores.id as avaliador_id', 'users.name', 'users.id', 'users.unidade_id', 'unidades.nome as unidade']);

        return view('avaliadores.create', compact('edital', 'users', 'avaliadores', 'subcomissoes'));
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
}
