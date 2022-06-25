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
                    'libelle' => 'Commune d\'Atar',
                    'sigle' => 'Atar',
                    'codification' => 'ATAR',
                    'departement_id' => 1,
                    'map' => 'map-default.png'
                ],
                [
                    'libelle' => 'Commune de Tawaz',
                    'sigle' => 'Tawaz',
                    'codification' => 'TAWAZ',
                    'departement_id' => 1,
                    'map' => 'map-default.png'
                ],
                [
                    'libelle' => 'Commune de Médina Gounass',
                    'sigle' => 'Médina Gounass',
                    'codification' => 'MEGOU',
                    'departement_id' => 3,
                    'map' => 'map-default.png'
                ]
            ]
        );
    }
}
