<?php

namespace App\Http\Controllers\AcoesExtensao;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;

use  App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\AcaoExtensao;
use App\Models\Unidade;
use App\Models\LinhaExtensao;
use App\Models\AreaTematica;
use App\Models\Municipio;

use App\Exports\AcoesExtensaoCienciaExport;

use App\Services\Comissao\BuscaUsuariosComissaoUnidade;

class AcaoExtensaoCienciaController extends Controller
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

        $acoes_extensao = AcaoExtensao::where('modalidade', "<>",1)
                                        ->where('status_comissao_graduacao', 'Sim')
                                        ->where('ciencia', 'Gerado')
                                        ->whereNull('ciencia_status')
                                        ->get();
        
        echo json_encode($acoes_extensao);
        // return view('acoes-extensao.ciencia-conext.index', [
        //     'acoes_extensao' => $acoes_extensao,
        //     'unidades' => $unidades,
        //     'linhas_extensao' => $linhas_extensao,
        //     'areas_tematicas' => $areas_tematicas,
        //     'estados' => $estados,
        //     'user'    => $user,
        // ]);
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
        
        AcaoExtensao::where('modalidade', "<>",1)
            ->where('status_comissao_graduacao', 'Sim')
            ->whereNull('ciencia')
            ->whereNull('ciencia_status')
            ->update(['ciencia' => 'Gerado']);

        return Excel::download(new AcoesExtensaoCienciaExport(), 'ciencia_conext_' . date('d_m_Y_H_i_m') . '.xlsx');
    }

    public function reconhecer()
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

        $acoes_extensao = AcaoExtensao::where('modalidade', "<>",1)
            ->where('status_comissao_graduacao', 'Sim')
            ->where('ciencia', 'Gerado')
            ->whereNull('ciencia_status')
            ->get();
        
        AcaoExtensao::where('modalidade', "<>",1)
            ->where('status_comissao_graduacao', 'Sim')
            ->where('ciencia', 'Gerado')
            ->whereNull('ciencia_status')
            ->update([
                'ciencia_status'   => 'Reconhecido',
            ]);

        if( $acoes_extensao->count() == 0 ) {
            session()->flash('status', 'Nenhuma ação foi reconhecida!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        if( $acoes_extensao->count() > 0 ) {
            // foreach($acoes_extensao as $acao_extensao){
            //     $acao_extensao->user->notify(new \App\Notifications\AcaoExtensaoNotificaReconhecimento($acao_extensao));
            //     $comissaoUnidade = BuscaUsuariosComissaoUnidade::execute($acao_extensao->unidade);
            //     Notification::send($comissaoUnidade, new \App\Notifications\AcaoExtensaoNotificarReconhecimentoComissaoUnidade($acao_extensao));
            // }
            
            session()->flash('status', 'Ações reconhecidas com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
    }
}
