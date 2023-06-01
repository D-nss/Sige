<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcaoExtensaoOcorrencia>
 */
class AcaoExtensaoOcorrenciaFactory extends Factory
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
            'acao_extensao_id'  => rand(1, 200),
            'local'             => $this->faker->sentence(),
            'data_hora_inicio'  => $this->faker->date(),
            'data_hora_fim'     => $this->faker->date(),
            'inicio_inscricoes' => $this->faker->date(),
            'fim_inscricoes'    => $this->faker->date(),
            'complemento'       => $this->faker->sentence(),
            'latitude'          => $this->faker->randomNumber(7, true),
            'longitude'         => $this->faker->randomNumber(7, true),
        ];
    }
}
