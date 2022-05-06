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
        //$this->middleware('role:admin,super')->except('index');
        //$this->middleware('role:admin,super')->except('index');
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
        $inputsParaValidar = $request->except(['anexo_imagem']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:1000';
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
            'total_recurso' => $request->total_recurso,
            'valor_max_inscricao' => $request->valor_max_inscricao,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Edital $edital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edital = Edital::findOrFail($id);
        return view('edital.edit', compact('edital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputsParaValidar = $request->except(['anexo_imagem']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:1000';
            }
            else {
                $validar[$key] = 'required';
            }
        }
        
        $validated = $request->validate($validar);
        
        $uploaded = new UploadFile();

        $anexo_edital = Edital::where('id',$id)->get(['anexo_edital', 'anexo_imagem'])->toArray();

        $edital = Edital::where('id',$id)
                        ->update([
                            'titulo' => $request->titulo,
                            'tipo' => $request->tipo,
                            'resumo' => $request->resumo,
                            'total_recurso' => $request->total_recurso,
                            'valor_max_inscricao' => $request->valor_max_inscricao,
                            'anexo_edital' => !!$request->anexo_edital ? $uploaded->execute($request, 'anexo_edital', 'pdf', 3000000) : $anexo_edital[0]['anexo_edital'],
                            'anexo_imagem' => !!$request->anexo_imagem ? $uploaded->execute($request, 'anexo_imagem', 'png', 3000000) : $anexo_edital[0]['anexo_imagem'],
                        ]);
        
        if($edital) {

            session()->flash('status', 'Edital Atualizado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("processo-editais/$id/editar");
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

    public function divulgar($id) 
    {
        $edital = Edital::findOrFail($id);
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
