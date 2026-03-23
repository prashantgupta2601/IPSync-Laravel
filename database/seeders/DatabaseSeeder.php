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
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Admin User
        $adminOptions = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ];
        $admin = User::where('email', 'admin@example.com')->first();
        if(!$admin) $admin = User::factory()->create($adminOptions);
        $admin->assignRole('admin');

        // Client User
        $clientOptions = [
            'name' => 'Client User',
            'email' => 'client@example.com',
            'role' => 'client',
            'password' => bcrypt('password'),
        ];
        $client = User::where('email', 'client@example.com')->first();
        if(!$client) $client = User::factory()->create($clientOptions);
        $client->assignRole('client');

        // IP Expert User
        $expertOptions = [
            'name' => 'IP Expert',
            'email' => 'expert@example.com',
            'role' => 'expert',
            'password' => bcrypt('password'),
        ];
        $expert = User::where('email', 'expert@example.com')->first();
        if(!$expert) $expert = User::factory()->create($expertOptions);
        $expert->assignRole('expert');
    }
}
