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
        $usersData = [
            [
                'check' => [
                    'email' => 'admin@gmail.com',
                ],
                'data' => [
                    'name' => 'Admin Adminadze',
                    'role_id' => 1,
                    'email_verified_at' => now(),
                    'password' => Hash::make('admin'),
                ],
            ],
            [
                'check' => [
                    'email' => 'manager@gmail.com',
                ],
                'data' => [
                    'name' => 'Manager Manageradze',
                    'role_id' => 1,
                    'email_verified_at' => now(),
                    'password' => Hash::make('manager'),
                ],
            ],
            [
                'check' => [
                    'email' => 'user@gmail.com',
                ],
                'data' => [
                    'name' => 'User Useradze',
                    'role_id' => 1,
                    'email_verified_at' => now(),
                    'password' => Hash::make('user'),
                ],
            ],
        ];

        foreach ($usersData as $userData) {
            User::firstOrCreate($userData['check'], $userData['data']);
        }
    }
}
