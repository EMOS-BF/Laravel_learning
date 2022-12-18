<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //protected $model = Client::class;

    public function definition()
    {
        $pays = $this->faker->country();
        $ville = $this->faker->city();
        return [
            "nom" =>$this->faker->lastName(),
            "prenom "=>$this->faker->firstName(),
            "sexe" =>array_rand(['M','F'],1),
            "dateNaissance" =>$this->faker->dateTimeBetween("1980-01-01","2020-12-30"),
            "lieuNaissance" => "$pays ,$ville",
            "nationalité" =>$this->faker->country(),
            "ville" =>$ville,
            "pays"=> $pays,
            "Adresse" =>$this->faker->address(),
            "telephone1" =>$this->faker->phoneNumber(),
            "telephone2" =>$this->faker->phoneNumber(),
            "pieceIdentité" =>array_rand(["CNIB","passport"],1)
        ];
    }
}
