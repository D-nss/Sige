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

use App\Services\Comissao\BuscaUsuariosComissaoExtensao;

class AcaoExtensaoCienciaController extends Controller
{
    public function index(Collection $acoes_extensao = null)
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        if( !$user->hasRole('at_conext') ) {
            session()->flash('status', 'Desculpe! Somente AT Conext pode acessar e gerar a ciência');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $acoes_extensao = AcaoExtensao::where('modalidade', "!=", 1)
                                        ->where('status', 'Aprovado')
                                        ->where('ciencia', 'Gerado')
                                        ->whereNull('ciencia_status')
                                        ->get();

        return view('acoes-extensao.ciencia-conext.index', [
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
            $user = User::where('uid', Auth::user()->id)->first();
        }

        if( !$user->hasRole('at_conext') ) {
            session()->flash('status', 'Desculpe! Somente AT Conext pode acessar e gerar a deliberação');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        AcaoExtensao::where('modalidade', "!=", 1)
            ->where('status', 'Aprovado')
            ->whereNull('ciencia')
            ->whereNull('ciencia_status')
            ->update(['ciencia' => 'Gerado']);

        return Excel::download(new AcoesExtensaoCienciaExport(), 'ciencia_conext_' . date('d_m_Y_H_i_m') . '.xlsx');
    }

    public function reconhecer(Request $request)
    {
        if(App::environment('local')){
            $user = User::where('id', 3)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        if( !$user->hasRole('at_conext') ) {
            session()->flash('status', 'Desculpe! Somente AT Conext pode acessar e gerar a deliberação');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $count = 0;

        foreach($request->selecionados as $selecionado) {
            $linhas_afetadas = AcaoExtensao::where('modalidade', "!=",1)
            ->where('status', 'Aprovado')
            ->where('ciencia', 'Gerado')
            ->whereNull('ciencia_status')
            ->where('id', $selecionado)
            ->update([
                'ciencia_status'   => 'Reconhecido',
            ]);

            if($linhas_afetadas == 1) {
                $count += 1;
                $acao_extensao = AcaoExtensao::find($selecionado);
                $acao_extensao->user->notify(new \App\Notifications\AcaoExtensaoNotificaReconhecimento($acao_extensao));
                $comissaoUnidade = BuscaUsuariosComissaoExtensao::execute($acao_extensao->unidade);
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
