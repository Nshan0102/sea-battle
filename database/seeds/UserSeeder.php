<?php

use App\User;
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
        User::create([
            'name' => 'Nshan',
            'email' => 'Nshan@mail.ru',
            'password' => bcrypt('password')
        ]);
        User::create([
            'name' => 'Anna',
            'email' => 'Anna@mail.ru',
            'password' => bcrypt('password')
        ]);
    }
}
