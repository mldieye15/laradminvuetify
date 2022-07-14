<?php

namespace Database\Seeders\User;


use App\Models\User\Personne;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PersonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personne::insert(
            [
                [
                    'prenoms' => 'Amadou Bayal',
                    'nom' => 'DIAWARA',
                    'sexe' => 'HOMME',
                    'surnom' => 'abid',
                    'taille' => '1m 79',
                    'poids' => '62 Kg',
                    'fonction' => 'Eléve',
                    'ne_vers' => 0,
                    'date_naiss' => Carbon::create('2003', '03', '01'),
                    'lieu_naiss' => 'Dakar',
                    'pays_naiss' =>2,   //  sénégal
                    'pays_natio' =>1,   // mauritanie
                    'adresse' => 'Géritar, El Mina',
                    'telephone' => '74010101',
                    'civilite' => 'HOMME',
                    'photo'=>'photo2.jpg',
                    'email' => '',
                    'type_piece_ident' => 'APPRENANT',
                    'piece_ident' => '208I766',
                    'annee_naiss' => '',
                    'ne_vers_naiss' => '',
                    'cin' => '65XXXXX',
                    'passport' => ''
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
