<?php

namespace Database\Seeders\Localisation;

use App\Models\Localisation\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::insert(
            [
                [
                    'libelle' => 'Région d\'Adrar',
                    'sigle' => 'Adrar',
                    'codification' => 'MR-07',
                    'indicatif' => '007',
                    'pays_id' => 1,
                    'map' => 'adrar.png'
                ],
                [
                    'libelle' => 'Région d\'Assaba',
                    'sigle' => 'Assaba',
                    'codification' => 'MR-03',
                    'indicatif' => '003',
                    'pays_id' => 1,
                    'map' => 'assaba.png'
                ],
                [
                    'libelle' => 'Région de Brakna',
                    'sigle' => 'Brakna',
                    'codification' => 'MR-05',
                    'indicatif' => '005',
                    'pays_id' => 1,
                    'map' => 'brakna.png'
                ],
                [
                    'libelle' => 'Région de Dakhlet Nouadhibou',
                    'sigle' => 'Nouadhibou',
                    'codification' => 'MR-08',
                    'indicatif' => '008',
                    'pays_id' => 1,
                    'map' => 'nouadhibou.png'
                ],
                [
                    'libelle' => 'Région de Gorgol',
                    'sigle' => 'Gorgol',
                    'codification' => 'MR-04',
                    'indicatif' => '004',
                    'pays_id' => 1,
                    'map' => 'gorgol.png'
                ],
                [
                    'libelle' => 'Région de Guidimaka',
                    'sigle' => 'Guidimaka',
                    'codification' => 'MR-10',
                    'indicatif' => '010',
                    'pays_id' => 1,
                    'map' => 'guidimaka.png'
                ],
                [
                    'libelle' => 'Région de Hodh Ech Chargui',
                    'sigle' => 'Chargui',
                    'codification' => 'MR-01',
                    'indicatif' => '001',
                    'pays_id' => 1,
                    'map' => 'chargui.png'
                ],
                [
                    'libelle' => 'Région d\'Inchiri',
                    'sigle' => 'Inchiri',
                    'codification' => 'MR-12',
                    'indicatif' => '012',
                    'pays_id' => 1,
                    'map' => 'inchiri.png'
                ],
                [
                    'libelle' => 'Région de Tagant',
                    'sigle' => 'Tagant',
                    'codification' => 'MR-09',
                    'indicatif' => '009',
                    'pays_id' => 1,
                    'map' => 'tagant.png'
                ],
                [
                    'libelle' => 'Région de Tiris Zemmour',
                    'sigle' => 'Tiris',
                    'codification' => 'MR-11',
                    'indicatif' => '011',
                    'pays_id' => 1,
                    'map' => 'tiris.png'
                ],
                [
                    'libelle' => 'Région de Trarza',
                    'sigle' => 'Trarza',
                    'codification' => 'MR-06',
                    'indicatif' => '006',
                    'pays_id' => 1,
                    'map' => 'trarza.png'
                ],
                [
                    'libelle' => 'Région de Dakar',
                    'sigle' => 'Dakar',
                    'codification' => 'DK',
                    'indicatif' => '8',
                    'pays_id' => 2,
                    'map' => 'map-default.png'
                ],
            ]
        );
    }
}
