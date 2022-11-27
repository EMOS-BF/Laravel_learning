<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatutLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statutlocation')->insert(
            [
                ["nom" => "En cours"],
                ["nom" => "En attente"],
                ["nom" => "terminé"],
            ]
           );
    }
}
