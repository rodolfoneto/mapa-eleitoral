<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('states')->insert([
        //     'name' => 'Pernambuco',
        //     'uf' => 'PE',
        // ]);

        DB::table('cities')->insert([
            'name' => 'Recife',
            'state_id' => 1,
            'tse_id' => 'REC',
            'mayor_name' => 'Prefeito de Recife',
            'habitant_qty' => 1500000,
            'electures_qty' => 400000,
        ]);
    }
}
