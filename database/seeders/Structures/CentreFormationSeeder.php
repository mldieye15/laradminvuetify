<?php

namespace Database\Seeders\Structures;

use App\Models\Structures\CentreFormation;
use Illuminate\Database\Seeder;

class CentreFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CentreFormation::insert(
            [
                [
                    'libelle' => 'Centre de Formation Jantart',
                    'sigle' => 'CFJ',
                    'ligue_regionale_id' => 1,
                    'visible' => 1,
                    'email' => 'cfjantart.lr-adrar@gmail.com',
                    'adresse' => 'Djokol, Rue Siral Finat',
                    'telephone' => '3300000001',
                    'logo' => 'map-default.png',
                    'type_structure_id' => 3
                ]
            ]
        );
    }
}

