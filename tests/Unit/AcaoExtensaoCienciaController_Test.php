<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\AcoesExtensao\AcaoExtensaoCienciaController;
use Maatwebsite\Excel\Facades\Excel;



class AcaoExtensaoCienciaController_Test extends TestCase
{
    //iremos testar as principais funções do AcaoExtensaoCienciaController
    public function test_gerarExcel(){

        //testa se é possivel fazer o download do excel no ambiente local

        $collection = new AcaoExtensaoCienciaController();
        Excel::fake();
        $collection->gerarExcel();
        Excel::assertDownloaded('ciencia_conext_' . date('d_m_Y_H_i_m') . '.xlsx', );
    }
}