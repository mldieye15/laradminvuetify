<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Departement;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departement::insert(
            [
                [
                    'libelle' => 'Département de Dakar',
                    'sigle' => 'Dakar',
                    'codification' => 'DK',
                    'visible' => 1,
                    'region_id' => 1,
                    'map' => 'map-default.png'
                ],
                [
                    'libelle' => 'Département d\'Atar',
                    'sigle' => 'Atar',
                    'codification' => 'ATR',
                    'visible' => 1,
                    'region_id' => 3,
                    'map' => 'map-default.png'
                ],
                [
                    'libelle' => 'Département de Guédiawaye',
                    'sigle' => 'Guédiawaye',
                    'codification' => 'GWY',
                    'visible' => 1,
                    'region_id' => 1,
                    'map' => 'map-default.png'
                ]
            ]
        );
    }
}
