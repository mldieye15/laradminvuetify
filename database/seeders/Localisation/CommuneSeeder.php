<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Commune;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commune::insert(
            [
                [
                    'libelle' => 'Commune de Médina Gounass',
                    'sigle' => 'Gounass',
                    'codification' => 'MEDGUNAS',
                    'visible' => 1,
                    'departement_id' => 3,
                    'map' => 'map-default.png'
                ]
            ]
        );
    }
}
