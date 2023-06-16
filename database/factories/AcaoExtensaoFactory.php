<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcaoExtensao>
 */
class AcaoExtensaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->locale('pt_BR');

        return [
            'user_id' => rand(1,3),
            'modalidade' => rand(1,5),
            'linha_extensao_id' => rand(1,53),
            'titulo' => $this->faker->sentence(),
            'descricao' => $this->faker->text(),
            'palavras_chaves' => $this->faker->word() .','. $this->faker->word() .','. $this->faker->word(),
            'url' => $this->faker->url(),
            'publico_alvo' => $this->faker->sentence(),
            'estimativa_publico' => rand(20,1000),
            'municipio_id' => rand(3268, 3912),
            'unidade_id' => rand(1, 43),
            'nome_coordenador' => $this->faker->name(),
            'vinculo_coordenador' => $this->faker->jobTitle(),
            'email_coordenador' => $this->faker->companyEmail(),
            'vagas_curricularizacao' => rand(5,20),
            'qtd_horas_curricularizacao' => rand(5,20),
            'grau_envolvimento_equipe_id' => rand(1,7),
            'impactos_universidade' => $this->faker->text(),
            'impactos_sociedade' => $this->faker->text(),
            'aprovado_user_id' => rand(1,3),
            'status' => $this->faker->randomElement($array = array ('Rascunho','Pendente','Aprovado')),
        ];
    }
}
