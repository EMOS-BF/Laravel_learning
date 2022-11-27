<?php

namespace Database\Seeders;

use App\Models\TypeChambre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeChambreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*$types= array(
        ['Description'=> 'climatisé'],
        ['Description'=> 'ventillé'],
       );
       foreach($types as $type){
        TypeChambre::create($type);
       }*/
       DB::table('type_chambres')->insert(
        [
            ["Description" => "climatisé"],
            ["Description" => "ventilé"],
        ]
       );
    }
}
