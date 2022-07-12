<?php

namespace Database\Seeders;

use Database\Seeders\Federation\FederationSeeder;
use Database\Seeders\Federation\LigueRegionaleSeeder;
use Database\Seeders\Federation\SportSeeder;
use Database\Seeders\Localisation\ContinentSeeder;
use Database\Seeders\Localisation\PaysSeeder;
use Database\Seeders\Localisation\RegionSeeder;
use Database\Seeders\Localisation\DepartementSeeder;
use Database\Seeders\Localisation\CommuneSeeder;
use Database\Seeders\Localisation\QuartierSeeder;
use Database\Seeders\Structures\AssociationSeeder;
use Database\Seeders\Structures\CentreFormationSeeder;
use Database\Seeders\Structures\ClubSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContinentSeeder::class);
        $this->call(PaysSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(DepartementSeeder::class);
        $this->call(CommuneSeeder::class);
        $this->call(QuartierSeeder::class);
        $this->call(SportSeeder::class);
        $this->call(FederationSeeder::class);
        $this->call(LigueRegionaleSeeder::class);
        $this->call(ClubSeeder::class);
        $this->call(CentreFormationSeeder::class);
        $this->call(AssociationSeeder::class);
        $this->call(UserSeeder::class);
    }
}
