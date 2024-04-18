<?php

namespace App\Exports;

use App\Models\AcaoExtensao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcoesExtensaoCienciaExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Titulo',
            'Modalidade',
            'Linha de Extensão',
            'Áreas Temáticas',
            'ODS',
            'Coordenador',
            'Unidade',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $modalidades = [
            1 => 'Programa',                           
            2 => 'Projeto',
            3 => 'Curso',
            4 => 'Evento',
            5 => 'Prestação de serviços',
            6 => 'Indefinido'
        ];

        $acoes_extensao = AcaoExtensao::where('modalidade', "!=", 1)
        ->where('status', 'Aprovado')
        ->where('ciencia', 'Gerado')
        ->whereNull('ciencia_status')
        ->get();
            
        $camposAcoesExcel = [];

        foreach($acoes_extensao as $acao) {
            $areas = '';
            foreach($acao->areas_tematicas as $area_tematica) {
                $areas .= $area_tematica->nome . " / ";
            }

            $odsAgrupadas = '';
            foreach($acao->objetivos_desenvolvimento_sustentavel as $ods) {
                $odsAgrupadas .= $ods->nome ." / ";
            }

            array_push($camposAcoesExcel, [
                $acao->titulo, 
                $modalidades[$acao->modalidade],
                $acao->linha_extensao->nome,
                $areas,
                $odsAgrupadas,
                $acao->nome_coordenador,
                $acao->unidade->sigla
            ]);
        }
        return collect($camposAcoesExcel);
    }
}
