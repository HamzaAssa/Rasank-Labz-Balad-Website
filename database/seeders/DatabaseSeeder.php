<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('words')->insert([
            'word' => '',
            'language' => 'BL',
            'status' => 2
        ]);
        DB::table('words')->insert([
            'word' => '',
            'language' => 'UR',
            'status' => 2
        ]);
        DB::table('words')->insert([
            'word' => '',
            'language' => 'EN',
            'status' => 2
        ]);
        DB::table('words')->insert([
            'word' => '',
            'language' => 'RB',
            'status' => 2
        ]);
    }
}
