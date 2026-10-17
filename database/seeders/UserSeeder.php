<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Rachel Tabita',
                'email' => 'rachel@admin.test',
                'password' => Hash::make('rachel@admin'),
            ],
            [
                'name' => 'Carmenita',
                'email' => 'carmenita@admin.test',
                'password' => Hash::make('carmenita@admin'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
