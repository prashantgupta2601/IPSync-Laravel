<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        $adminOptions = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ];
        $admin = User::where('email', 'admin@example.com')->first();
        if(!$admin) User::create($adminOptions);

        // Client User
        $clientOptions = [
            'name' => 'Client User',
            'email' => 'client@example.com',
            'role' => 'client',
            'password' => bcrypt('password'),
        ];
        $client = User::where('email', 'client@example.com')->first();
        if(!$client) User::create($clientOptions);

        // IP Expert User
        $expertOptions = [
            'name' => 'IP Expert',
            'email' => 'expert@example.com',
            'role' => 'expert',
            'password' => bcrypt('password'),
        ];
        $expert = User::where('email', 'expert@example.com')->first();
        if(!$expert) User::create($expertOptions);
    }
}
