<?php

namespace App\Http\Controllers\AcoesExtensao;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\AcaoExtensao;
use App\Models\Unidade;
use App\Models\LinhaExtensao;
use App\Models\AreaTematica;
use App\Models\Municipio;

use App\Exports\AcoesExtensaoDeliberacaoExport;

use App\Services\Comissao\BuscaUsuariosComissaoUnidade;

class AcaoExtensaoDeliberacaoController extends Controller
{
    public function index(Collection $acoes_extensao = null)
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( !$user->hasRole('at_conext') ) {
            session()->flash('status', 'Desculpe! Somente AT Conext pode acessar e gerar a deliberação');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $acoes_extensao = AcaoExtensao::where('status', 'Aprovado')
                                        ->where('aceite_comite', 'Sim')
                                        ->where('deliberacao', 'Gerado')
                                        ->whereNull('status_avaliacao_conext')
                                        ->whereNull('avaliacao_conext_user_id')
                                        ->get();
        
        return view('acoes-extensao.deliberacao-conext.index', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'user'    => $user,
        ]);
    }

    public function gerarExcel()
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( !$user->hasRole('at_conext') ) {
            session()->flash('status', 'Desculpe! Somente AT Conext pode acessar e gerar a deliberação');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        
        AcaoExtensao::where('status', 'Aprovado')
            ->where('aceite_comite', 'Sim')
            ->whereNull('deliberacao')
            ->whereNull('status_avaliacao_conext')
            ->whereNull('avaliacao_conext_user_id')
            ->update(['deliberacao' => 'Gerado']);

        return Excel::download(new AcoesExtensaoDeliberacaoExport(), 'deliberacao_conext_' . date('d_m_Y_H_i_m') . '.xlsx');
    }

    public function reconhecer(Request $request)
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( !$user->hasRole('at_conext') ) {
            session()->flash('status', 'Desculpe! Somente AT Conext pode acessar e gerar a deliberação');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $count = 0;

        foreach($request->selecionados as $selecionado) {
            $linhas_afetadas =  AcaoExtensao::where('status', 'Aprovado')
                ->where('aceite_comite', 'Sim')
                ->where('deliberacao', 'Gerado')
                ->whereNull('status_avaliacao_conext')
                ->whereNull('avaliacao_conext_user_id')
                ->where('id', $selecionado)
                ->update([
                    'status_avaliacao_conext'   => 'Reconhecido',
                    'avaliacao_conext_user_id'  => $user->id
                ]);

                if($linhas_afetadas == 1) {
                    $count += 1;
                    $acao_extensao = AcaoExtensao::find($selecionado);
                    $acao_extensao->user->notify(new \App\Notifications\AcaoExtensaoNotificaReconhecimento($acao_extensao));
                    $comissaoUnidade = BuscaUsuariosComissaoUnidade::execute($acao_extensao->unidade);
                    Notification::send($comissaoUnidade, new \App\Notifications\AcaoExtensaoNotificarReconhecimentoComissaoUnidade($acao_extensao));
                }
        }

        if( $count == 0 ) {
            session()->flash('status', 'Nenhuma ação foi reconhecida!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        if( $count > 0 ) {
            
            session()->flash('status', 'Ações reconhecidas com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
    }
}
