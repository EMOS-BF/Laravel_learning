<?php

namespace Database\Factories;

use App\Models\TypeChambre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\typechambre>
 */
class typechambreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //protected $model = TypeChambre::class;

    public function definition()
    {
        return [
            "Description"=>array_rand(["climatisé", "ventilé"], 1)
        ];
    }
}
