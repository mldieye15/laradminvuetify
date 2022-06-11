<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::insert(
            [
                [
                    'libelle' => 'Région de Dakar',
                    'sigle' => 'Dakar',
                    'codification' => 'DK',
                    'indicatif' => '8',
                    'visible' => 1,
                    'pays_id' => 2
                ],
                [
                    'libelle' => 'Région de Saint-louis',
                    'sigle' => 'Saint-louis',
                    'codification' => 'SL',
                    'indicatif' => '9',
                    'visible' => 1,
                    'pays_id' => 2
                ],
                [
                    'libelle' => 'Région d\'Adrar',
                    'sigle' => 'Adrar',
                    'codification' => 'ADR',
                    'indicatif' => '12',
                    'visible' => 1,
                    'pays_id' => 1
                ],
            ]
        );
    }
}
