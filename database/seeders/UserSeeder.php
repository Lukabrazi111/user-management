<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'Lukabrazi111',
            'email' => 'luka@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(10)->create();
    }
}
