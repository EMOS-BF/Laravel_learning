<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DurreeLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duree_locations')->insert(
            [
                ["Libelle" => "Journée" , "ValeurEnHeure"=>24],
                ["Libelle" => "Demi-Journée" , "ValeurEnHeure"=>12],
            ]
           );
    }
}
