<?php

namespace Database\Seeders\Federation;

use App\Models\Federation\Federation;
use Illuminate\Database\Seeder;

class LigueRegionale extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Federation::insert(
            [
                [
                    'libelle' => 'Ligue régional Adrar',
                    'sigle' => 'LR-ADRAR',
                    'federation_id' => 1,
                    'region_id' => 1,
                    'email' => 'lr-adrar.fbrim@gmail.com',
                    'adresse' => 'Adrar, Rue Ahmed Ould Sidi Baba',
                    'telephone' => '3300000001',
                    'logo' => 'logo-fed.jpg'
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
