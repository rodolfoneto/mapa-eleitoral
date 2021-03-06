<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'rodolfoneto@gmail.com',
        //     'password' => bcrypt('123456'),
        // ]);
        User::create([
            'name' => 'Cumbuca',
            'email' => 'diego@cumbuca.ag',
            'password' => bcrypt('cumbuca@123'),
        ]);
    }
}
