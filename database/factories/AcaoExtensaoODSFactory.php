<?php

namespace Database\Factories;

use App\Models\AcaoExtensaoODS;
use App\Models\ObjetivoDesenvolvimentoSustentavel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcaoExtensaoODS>
 */
class AcaoExtensaoODSFactory extends Factory
{

    private static $acao_extensao = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'acao_extensao_id' => self::$acao_extensao++,
            'objetivo_desenvolvimento_sustentavel_id' => ObjetivoDesenvolvimentoSustentavel::inRandomOrder()->first()->id
            //
        ];
    }
}
