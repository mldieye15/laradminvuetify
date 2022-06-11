<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                'name' => 'Yusru Technologie',
                'email' => 'yusru.tech@gmail.com',
                'password' => '$2y$10$sC.QK41EvDETpb/Ac9EK3OyjMlXpbdywv6MaiTaS8mq5gJh6wPHEC', //passer123
                'remember_token' =>  Str::random(40)
            ]
        );
    }
}
