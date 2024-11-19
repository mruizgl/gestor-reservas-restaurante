<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User 1',
                'email' => 'melissa@restaurante.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin User 2',
                'email' => 'noelia@restaurante.com',
                'password' => Hash::make('admin'), 
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
        ]);
    }
}
