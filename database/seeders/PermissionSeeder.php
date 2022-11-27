<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
            [
                ["nom" => "Ajouter un client"],
                ["nom" => "Editer un client"],
                ["nom" => "Consulter un client"],

                ["nom" => "Ajouter une location"],
                ["nom" => "Editer une location"],
                ["nom" => "Consulter une location"],

                ["nom" => "Ajouter une chambre"],
                ["nom" => "Editer une chambre"],
                ["nom" => "Consulter une chambre"],
            ]
           );
    }
}
