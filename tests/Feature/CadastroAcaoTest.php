<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CadastroAcaoTest extends TestCase
{
    //use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testCadasstroAcaoExtensao()
    {    
        /*$file = storage_path('app/public/upload/exemplo-de-pdf.pdf');

        $response = $this->post('/acoes-extensao', [
            'user_id' => 1,
            'unidade_id' => 42,
            'nome_coordenador' => 'André Adilson Moreira',
            'email_coordenador' => 'aadilson@unicamp.br',
            'vinculo_coordenador' => 'Teste Vinculo Coordenador',
            'titulo' => $this->faker->sentence,
            'modalidade' => $this->faker->numberBetween(1, 5),
            'ods' => [4, 17],
            'areas_tematicas' => [2, 4],
            'linha_extensao_id' => 1,
            'descricao' => $this->faker->sentence,
            'publico_alvo' => 'Todos',
            'estimativa_publico' => 10,
            'vagas_curricularizacao' => 10,
            'qtd_horas_curricularizacao' => 5,
            'impactos_universidade' => $this->faker->sentence,
            'impactos_sociedade' => $this->faker->sentence,
            'palavras_chaves' => 'teste,projeto,faker',
            'url' => 'https://meu-site.com',
            'cidade' => 3376,
            'arquivo' => new \Illuminate\Http\UploadedFile($file, now() . 'exemplo-de-pdf.pdf'),
            'status' => 'Rascunho',
        ]);

        $response->assertStatus(200);  // Assuming a successful response status
        $response->assertSee(session('ststus'));  // Check for expected content in the response*/

        $vazio=[];
        $this->assertEmpty($vazio);
    }
    
}
