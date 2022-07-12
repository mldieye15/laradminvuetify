<?php

namespace Database\Seeders\Structures;

use App\Models\Structures\Club;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Club::insert(
            [
                [
                    'libelle' => 'Atrar Basketball Club',
                    'sigle' => 'ABC',
                    'ligue_regionale_id' => 1,
                    'visible' => 1,
                    'email' => 'abc.lr-adrar@gmail.com',
                    'adresse' => 'Gndikh, Rue Kamal Ahmad',
                    'telephone' => '3300000001',
                    'logo' => 'map-default.png'
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
