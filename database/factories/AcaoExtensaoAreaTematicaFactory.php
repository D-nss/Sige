<?php

namespace Database\Factories;

use App\Models\AcaoExtensaoAreaTematica;
use App\Models\AreaTematica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcaoExtensaoAreaTematica>
 */
class AcaoExtensaoAreaTematicaFactory extends Factory
{

    private static $acao_extensao = 1;

    protected $model = AcaoExtensaoAreaTematica::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = $this->faker;

        return [
            'acao_extensao_id' => self::$acao_extensao++,
            'area_tematica_id' => AreaTematica::inRandomOrder()->first()->id
            //
        ];
    }
}
