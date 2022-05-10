<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Cronograma;

class CronogramaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-administrador,super');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = array();
        $validar = array();

        foreach($request->all() as $key => $inputs) {
            $validar[$key] = 'required';
        }

        $validated = $request->validate($validar);

        $edital_id = $request->edital_id;

        foreach($request->all() as $key => $r) {

            if($key == '_token' || $key == 'edital_id') {
                continue;
            }

            array_push($dados, array('dt_input' => $key, 'data' => $r, 'edital_id' => $edital_id));
        }

        $cronogramas = DB::table('cronogramas')->insert($dados);

        if($cronogramas)
        {
            session()->flash('status', 'Cronograma cadastrado com sucesso!');
            session()->flash('alert', 'success');
            return redirect("processo-editais/$edital_id/editar");
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao cadastrar o cronograma');
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
    public function show(Cronograma $cronograma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cronograma $cronograma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $edital_id)
    {
        $validar = array();

        foreach($request->all() as $key => $inputs) {
            $validar[$key] = 'required';
        }

        $validated = $request->validate($validar);
        
        $linhasAfetadas = array();

        foreach($request->input() as $key => $r){
            //descarta os campos que não se referem as datas do cronograma
            if($key == '_token' || $key == 'edital_id' || $key == '_method') {
                continue;
            }
            //atualiza as datas
            $linha = DB::table('cronogramas')->where('edital_id', $edital_id)->where('dt_input', $key)->update([ 'data' => $r ]);
            array_push($linhasAfetadas, $linha);
            
        }

        //checa se ocorreu tudo certo com base no array linhasAfetadas
        if(!in_array(0, $linhasAfetadas))
        {
            session()->flash('status', 'Todas as datas do cronograma foram atualizadas com sucesso!');
            session()->flash('alert', 'success');
            return redirect("processo-editais/$edital_id/editar");
        }
        else
        {
            if(count(array_unique($linhasAfetadas)) == 1)
            {
                session()->flash('status', 'Nenhuma data do cronograma foi atualizada.');
                session()->flash('alert', 'warning');
                return redirect()->back();
            }
            else{
                session()->flash('status', 'Somente as datas do cronograma alteradas foram atualizadas.');
                session()->flash('alert', 'warning');
                return redirect("processo-editais/$edital_id/editar");
            }

        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cronograma $cronograma)
    {
        //
    }

    public function prorrogar(Request $request) 
    {
        $cronogramas = Cronograma::where('edital_id', $request->edital_id)->get();

        foreach($cronogramas as $c) {
            $cronograma = Cronograma::find($c->id);
            /* checa e altera somente as datas maiores que a data atual */
            if($cronograma->data >= date('Y-m-d')) {
                /* acrescenta a quantidade de dias vindo da requisição */
                $data = date('Y-m-d', strtotime("+$request->dias days", strtotime($cronograma->data)));
                $diaSemana = date('w', strtotime($data));
                /* verifica se o dia da semana é DOMINGO e adiciona mais um dia */
                if($diaSemana == 0) {
                    $data = date('Y-m-d', strtotime("+1 days", strtotime($data)));
                }
                /* verifica se o dia da semana é SABADO e adiciona mais dois dia */
                if($diaSemana == 6) {
                    $data = date('Y-m-d', strtotime("+2 days", strtotime($data)));
                }

                $cronograma->data = $data;
                $cronograma->update();
            }
            
        }

        session()->flash('status', 'As proximas datas do cronograma foram prorrogadas em ' . $request->dias . ' dias.');
        session()->flash('alert', 'success');
        return redirect()->back();
    }
}
