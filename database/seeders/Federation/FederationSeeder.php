<?php

namespace Database\Seeders\Federation;

use App\Models\Federation\Federation;
use Illuminate\Database\Seeder;

class FederationSeeder extends Seeder
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
                    'libelle' => 'Fédération de Basketball',
                    'sigle' => 'FB-RIM',
                    'sport_id' => 1,
                    'pays_id' => 1,
                    'visible' => 1,
                    'email' => 'fb.rim@gmail.com',
                    'adresse' => 'Nouakchout, Rue Ould Ahmad 202',
                    'telephone' => '3300000001',
                    'logo' => 'logo-fed.jpg'
                ]
            ]
        );
    }
}
