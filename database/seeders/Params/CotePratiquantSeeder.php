<?php

namespace Database\Seeders\Params;

use App\Models\Params\CotePratiquant;
use Illuminate\Database\Seeder;

class CotePratiquantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CotePratiquant::insert(
            [
                [
                    'libelle' => 'Gauche',
                    'sigle' => 'Gauche',
                    'active' => 1
                ],
                [
                    'libelle' => 'Droite',
                    'sigle' => 'Droite',
                    'active' => 1
                ],
                [
                    'libelle' => 'Gauche-Droite',
                    'sigle' => 'Gauche-Droite',
                    'active' => 1
                ]
            ]
        );
    }
}
