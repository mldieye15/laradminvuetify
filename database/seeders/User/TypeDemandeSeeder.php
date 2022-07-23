<?php

namespace Database\Seeders\User;

use App\Models\User\TypeDemande;
use Illuminate\Database\Seeder;

class TypeDemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDemande::insert(
            [
                [
                    'libelle' => 'Pratiquants',
                    'sigle' => 'Pratiquant',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Techniciens',
                    'sigle' => 'Techniciens',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Médecins',
                    'sigle' => 'Médecins',
                    'visible' => 1,
                ]
            ]
        );
    }
}
