<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Create an admin user with a hashed password
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // Hash the password
            'role' => 'admin',
        ]);
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
