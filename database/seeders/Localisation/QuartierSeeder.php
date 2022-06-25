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
                    'commune_id' => 3
                ],
                [
                    'libelle' => 'Quartier Parc Gounass',
                    'sigle' => 'Parc',
                    'codification' => 'PARCGUNAS',
                    'commune_id' => 3
                ]
            ]
        );
    }
}
