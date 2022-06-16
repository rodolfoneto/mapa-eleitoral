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
        DB::table('responsibilities')->insert(["title" => "Governador"],);
        DB::table('responsibilities')->insert(["title" => "Deputado Estadual",],);
        DB::table('responsibilities')->insert(["title" => "Deputado Federal",],);
    }
}
