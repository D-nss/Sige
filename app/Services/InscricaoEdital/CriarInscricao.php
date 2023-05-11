<?php

namespace App\Services\InscricaoEdital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Inscricao;
use App\Models\Edital;
use App\Models\UploadFile;
use App\Models\User;

class CriarInscricao
{
    public static function execute(Request $request, $user)
    {
        $areasTematicasInsert = array();
        $odsInsert = array();
        $respostasQuestoesInsert = array();
        $upload = new UploadFile();

        DB::transaction(function() use( $request, $areasTematicasInsert, $odsInsert, $respostasQuestoesInsert, $upload, $user) {
            /* Faz a inserção da inscrição */
            $inscricaoCriada = Inscricao::create([
                'titulo' => $request->titulo,
                'tipo' => $request->tipo_extensao,
                'municipio_id' => $request->cidade,
                'resumo' => $request->resumo,
                'palavras_chaves' => $request->palavras_chaves,
                'parceria' => $request->parceria,
                'anexo_parceria' => !!$request->comprovante_parceria ? $upload->execute($request, 'comprovante_parceria', 'pdf', 30000000) : '',
                'anexo_projeto' => $upload->execute($request, 'pdf_projeto', 'pdf', 30000000),
                'url_projeto' => $request->link_projeto,
                'url_lattes' => $request->link_lattes,
                'status' => 'Salvo',
                'linha_extensao_id' => $request->linha_extensao,
                'user_id' => $user->id,
                'unidade_id' => $user->unidade->id,
                'edital_id' => $request->edital_id,
                'qtde_alunos' => $request->qtde_alunos,
                'qtde_alunos_pg' => $request->qtde_alunos_pg,
                'qtde_alunos_ct' => $request->qtde_alunos_ct
            ]);
            /* Prepara os dados para inserção das areas temáticas */
            foreach($request->areas_tematicas as $areas) {
                array_push($areasTematicasInsert,[
                    'area_tematica_id' => $areas,
                    'inscricao_id' => $inscricaoCriada->id
                ]);
            }
            /* faz a inserção das áreas temáticas */
            DB::table('inscricoes_areas_tematicas')->insert($areasTematicasInsert);
            
            /* Prepara os dados para inserção das ODS */
            foreach($request->obj_desenvolvimento_sustentavel as $ods) {
                array_push($odsInsert,[
                    'objetivo_desenvolvimento_sustentavel_id' => $ods,
                    'inscricao_id' => $inscricaoCriada->id
                ]);
            }
            /* faz a inserção das ODS's */
            DB::table('inscricoes_editais_ods')->insert($odsInsert);

            /* prepara os dados para inserção das respostas das questões complementares */
            foreach($request->all() as $key => $resposta) {
                if(substr($key, 0, 8) == 'questao-') {
                    array_push($respostasQuestoesInsert, [
                        'questao_id' => substr($key, 8, strlen($key)),
                        'inscricao_id' => $inscricaoCriada->id,
                        'resposta' => $resposta
                    ]);
                }
            }
            /* faz a inserção das respostas das questões complementares */
            DB::table('questoes_respondidas')->insert($respostasQuestoesInsert);

            return $inscricaoCriada;
        });
    }
}