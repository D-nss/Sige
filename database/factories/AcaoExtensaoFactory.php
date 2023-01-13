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
            'user_id' => 1,
            'tipo' => rand(1,5),
            'linha_extensao_id' => rand(1,53),
            'titulo' => $this->faker->sentence(),
            'descricao' => $this->faker->text(),
            'palavras_chaves' => $this->faker->word(),
            'url' => $this->faker->url(),
            'publico_alvo' => $this->faker->sentence(),
            'data_inicio' => $this->faker->date(),
            'data_fim' => $this->faker->date(),
            'municipio_id' => rand(3268, 3912),
            //'situacao' => rand(1,3),
            'unidade_id' => rand(1, 40),
            'nome_coordenador' => $this->faker->name(),
            'vinculo_coordenador' => rand(1,4),
            /*
            'parceiro' => $this->faker->company(),
            'tipo_parceiro_id' => rand(1,13),*/
            'impactos_universidade' => $this->faker->text(),
            'impactos_sociedade' => $this->faker->text(),
            'grau_envolvimento_equipe_id' => rand(1,7),
            'investimento' => rand(10000,200000),
            'status' => 'Pendente',
        ];
    }
}
