<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Pays;
use Illuminate\Database\Seeder;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pays::insert(
            [
                [
                    'libelle' => 'République islamique de Mauritanie',
                    'sigle' => 'Mauritanie',
                    'code_alpha2' => 'MR',
                    'code_alpha3' => 'MRT',
                    'indicatif' => '222',
                    'visible' => 0,
                    'continent_id' => 1
                ],
                [
                    'libelle' => 'République du Sénégal',
                    'sigle' => 'Sénégal',
                    'code_alpha2' => 'SN',
                    'code_alpha3' => '',
                    'indicatif' => '221',
                    'visible' => 1,
                    'continent_id' => 1
                ],
            ]
        );
    }
}
