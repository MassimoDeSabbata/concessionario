<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'email' => 'debug@heply.it',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('admin');

    }
}
