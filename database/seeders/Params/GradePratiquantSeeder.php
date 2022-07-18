<?php

namespace Database\Seeders\Params;

use App\Models\Params\GradePratiquant;
use Illuminate\Database\Seeder;

class GradePratiquantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GradePratiquant::insert(
            [
                [
                    'libelle' => 'Minibasket',
                    'sigle' => 'U12',
                    'age_min' => 2,
                    'age_max' => 13,
                    'active' => 1,
                    'niveau' => 1
                ],
                [
                    'libelle' => 'Minime',
                    'sigle' => 'U14',
                    'age_min' => 13,
                    'age_max' => 15,
                    'active' => 1,
                    'niveau' => 2
                ],
                [
                    'libelle' => 'Cadet',
                    'sigle' => 'U16',
                    'age_min' => 15,
                    'age_max' => 17,
                    'active' => 1,
                    'niveau' => 3
                ],
                [
                    'libelle' => 'Junior',
                    'sigle' => 'U18',
                    'age_min' => 17,
                    'age_max' => 19,
                    'active' => 1,
                    'niveau' => 4
                ],
                [
                    'libelle' => 'Senior',
                    'sigle' => 'U20',
                    'age_min' => 19,
                    'age_max' => 21,
                    'active' => 1,
                    'niveau' => 5
                ],[
                    'libelle' => 'Equipe',
                    'sigle' => 'U21',
                    'age_min' => 21,
                    'age_max' => 99,
                    'active' => 1,
                    'niveau' => 6
                ],
            ]
        );
    }
}
