<?php

namespace Database\Seeders\Federation;

use App\Models\Federation\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sport::insert(
            [
                [
                    'libelle' => 'Basketball',
                    'sigle' => 'B',
                    'visible' => 1,
                ]
            ]
        );
    }
}
