<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responsabilities')->insert(["title" => "Governador"],);
        DB::table('responsabilities')->insert(["title" => "Deputado Estadual",],);
        DB::table('responsabilities')->insert(["title" => "Deputado Federal",],);
    }
}
