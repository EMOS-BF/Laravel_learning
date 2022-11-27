<?php

namespace Database\Factories;

use App\Models\TypeChambre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chambre>
 */
class ChambreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "numero_de_chambre"=> rand(1,10),
            "imageUrl"=> $this->faker->imageUrl(),
            // "type_chambre_id" =>TypeChambre::all()->random()->id,
            "type_chambre_id" =>rand(1,2),
            "EstDisponible"=>rand(0, 1)
        ];
    }
}

