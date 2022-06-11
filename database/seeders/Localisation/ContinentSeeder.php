<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Continent;
use Illuminate\Database\Seeder;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Continent::insert(
            [
                [
                    'libelle' => 'Afrique',
                    'sigle' => 'Afr',
                    'visible' => 1
                ],
                [
                    'libelle' => 'Europe',
                    'sigle' => 'Eur',
                    'visible' => 0
                ],
            ]
        );
    }
}
