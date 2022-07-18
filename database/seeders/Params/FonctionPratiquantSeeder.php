<?php

namespace Database\Seeders\Params;

use App\Models\Params\FonctionPratiquant;
use Illuminate\Database\Seeder;

class FonctionPratiquantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FonctionPratiquant::insert(
            [
                [
                    'libelle' => 'Meneur',
                    'sigle' => 'Meneur',
                    'active' => 1
                ],
                [
                    'libelle' => 'Arriére',
                    'sigle' => 'Arriére',
                    'active' => 1
                ],
                [
                    'libelle' => 'Ailier fort',
                    'sigle' => 'Ailier fort',
                    'active' => 1
                ],
                [
                    'libelle' => 'Pivot',
                    'sigle' => 'Pivot',
                    'active' => 1
                ],
            ]
        );
    }
}
