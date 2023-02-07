<?php

namespace Database\Factories;

use App\Models\AcaoExtensaoParceiro;
use App\Models\TipoParceiro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcaoExtensaoParceiro>
 */
class AcaoExtensaoParceiroFactory extends Factory
{

    private static $acao_extensao = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->locale('pt_BR');

        return [
            'acao_extensao_id' => self::$acao_extensao++,
            'tipo_parceiro_id' => TipoParceiro::inRandomOrder()->first()->id,
            'nome' => $this->faker->company(),
            'colaboracao' => $this->faker->sentence()
            //
        ];
    }
}
