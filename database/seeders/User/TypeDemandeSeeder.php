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
                    'sigle' => 'pratiquant',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Techniciens',
                    'sigle' => 'technicien',
                    'visible' => 1,
                ],
                [
                    'libelle' => 'Médecins',
                    'sigle' => 'medecin',
                    'visible' => 1,
                ]
            ]
        );
    }
}
