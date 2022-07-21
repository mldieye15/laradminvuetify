<?php

namespace Database\Seeders\Structures;

use App\Models\Structures\Association;
use App\Models\Structures\CentreFormation;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Association::insert(
            [
                [
                    'libelle' => 'ASC Chams 1',
                    'sigle' => 'CHAM1',
                    'ligue_regionale_id' => 1,
                    'visible' => 1,
                    'email' => 'cham1.lr-adrar@gmail.com',
                    'adresse' => 'Djokol, Rue Balhoultarit',
                    'telephone' => '3300000001',
                    'logo' => 'map-default.png',
                    'type_structure_id' => 4
                ]
            ]
        );
    }
}
/*
        'sologan',
        'fax',
        'date_creation',
        'recipisse_numero',
        'recipisse_date',
        'recipisse_url',
        'reglement_int_url',
        'page_web',
        'facebook',
        'whatsapp',
        'telegram',
        'instagram',
        'tiktok',
        'visible'
*/
