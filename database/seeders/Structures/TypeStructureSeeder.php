<?php

namespace Database\Seeders\Structures;

use App\Models\Structures\TypeStructure;
use Illuminate\Database\Seeder;

class TypeStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeStructure::insert(
            [
                [
                    'libelle' => 'Equipe nationale',
                    'sigle' => 'Equipe nationale',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Club',
                    'sigle' => 'Club',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Centre de formation',
                    'sigle' => 'Centre de formation',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Association',
                    'sigle' => 'Association',
                    'visible' => 1,
                ]
            ]
        );
    }
}
