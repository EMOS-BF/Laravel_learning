<?php

namespace Database\Seeders;

use App\Models\Client;
//use App\Models\chambre;
use App\Models\Chambre;
use Illuminate\Database\Seeder;
use Database\Seeders\ChambreSeeder;
use Database\Seeders\TypeChambreSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        // TypeChambreSeeder::class, 
        // ChambreSeeder::class,
        // ClientsTableSeeder::class,
    // ]);
    $this->call(TypeChambreSeeder::class);

    Chambre::factory(100)->create();
    $this->call(DurreeLocationSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(StatutLocationSeeder::class);
    Client::factory(100)->create();
    }
}
