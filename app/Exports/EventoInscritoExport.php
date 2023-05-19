<?php

namespace App\Exports;

use App\Models\Evento;
use App\Models\EventoInscrito;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

/*Classe é responsável por definir a estrutura e os dados que serão exportados para o arquivo Excel.*/
class EventoInscritoExport implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping
{
    protected $id_evento;

    //ID do evento setado no construtor como um parâmetro para filtrar os inscritos específicos desse evento.
    function __construct($id_evento) {
            $this->id_evento = $id_evento;
    }

    //Mapeamento da ordem das colunas
    public function map($inscrito): array
    {
        $inscrito->arquivo = isset($inscrito->arquivo) ? url('storage/'.$inscrito->arquivo) : '';

        return [
            $inscrito->nome,
            $inscrito->nome_social,
            $inscrito->email,
            $inscrito->tipo_documento,
            $inscrito->documento,
            $inscrito->sexo,
            $inscrito->genero,
            Date::stringToExcel($inscrito->nascimento),
            $inscrito->municipio,
            $inscrito->pais,
            $inscrito->area,
            $inscrito->funcao,
            $inscrito->instituicao,
            $inscrito->vinculo,
            $inscrito->etnico_racial,
            $inscrito->deficiencia,
            $inscrito->desc_deficiencia,
            $inscrito->personalizado,
            $inscrito->titulo_trabalho,
            $inscrito->arquivo,
            $inscrito->status_arquivo,
            Date::dateTimeToExcel($inscrito->created_at),
            Date::dateTimeToExcel($inscrito->updated_at)
        ];
    }

    //Formatação das colunas de datas
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'V' => NumberFormat::FORMAT_DATE_DATETIME,
            'W' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    //Habilitação e personalização do cabeçalho do arquivo exportado
    public function headings(): array
    {
        //Inclusão do informação do input do campo personalizado quando há
        $evento = Evento::where('id', $this->id_evento)->first();
        $input_personalizado = isset($evento->input_personalizado) ? $evento->input_personalizado : 'Campo Ausente';

        return [
            'Nome Completo',
            'Nome Social',
            'Email',
            'Tipo Documento',
            'Documento',
            'Sexo',
            'Gênero',
            'Data Nascimento',
            'Cidade/Estado',
            'Pais',
            'Área Atuação',
            'Função',
            'Instituição',
            'Vinculo Unicamp',
            'Autodeclaração Étnico Racial',
            'Possui Alguma Deficiência',
            'Descrição Deficiencia',
            $input_personalizado,
            'Título do Trabalho',
            'Caminho Arquivo',
            'Estado do Arquivo',
            'Inscrição Feita em',
            'Inscricao Atualizada em'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    *
    * Seleção dos campos importantes para exportação, dos inscritos confirmados e que não estão na lista de espera
    */
    public function collection()
    {
        return EventoInscrito::select('nome', 'nome_social',  'email',  'tipo_documento',  'documento', 'sexo',  'genero', 'nascimento', 'municipio',  'pais',  'area', 'funcao', 'instituicao', 'vinculo', 'etnico_racial', 'deficiencia',  'desc_deficiencia', 'personalizado', 'titulo_trabalho', 'arquivo', 'status_arquivo', 'created_at',  'updated_at')
                               ->where('confirmacao', 1)->where('lista_espera', 0)->where('evento_id', $this->id_evento)
                               ->get();
    }
}
