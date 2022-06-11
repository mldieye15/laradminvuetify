<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Quartier;
use Illuminate\Database\Seeder;

class QuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quartier::insert(
            [
                [
                    'libelle' => 'Quartier Médina Gounass',
                    'sigle' => 'Gounass',
                    'codification' => 'MEDGUNAS',
                    'visible' => 1,
                    'commune_id' => 1
                ],
                [
                    'libelle' => 'Quartier Parc Gounass',
                    'sigle' => 'Parc',
                    'codification' => 'PARCGUNAS',
                    'visible' => 1,
                    'commune_id' => 1
                ]
            ]
        );
    }
}
