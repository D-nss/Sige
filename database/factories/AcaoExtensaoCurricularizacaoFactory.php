<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AcaoExtensaoCurricularizacaoFactory extends Factory
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
            'acao_extensao_ocorrencia_id' => rand(1,10),
            'aluno_ra'                    => rand(1,9999),
            'status'                      => $this->faker->randomElement($array = array ('Aceito','Não Aceito')),
            'horas'                       => $this->faker->randomFloat(1, 1, 30),
            'apto'                        => $this->faker->boolean(),

        ];
    }
}
