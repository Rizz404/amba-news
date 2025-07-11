<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // * Admin user
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('177013'),
            'role' => "admin",
            'profile_picture_url' => "https://i.pinimg.com/736x/c6/ee/a1/c6eea122496fbe5aadc69231fddd5e2e.jpg"
        ]);

        // * User
        User::create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
            'role' => "user",
            'profile_picture_url' => "https://i.pinimg.com/736x/43/08/5c/43085cd7be90d65f3e16000038f57f6f.jpg"
        ]);

        // * Author
        User::create([
            'username' => 'author',
            'email' => 'author@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('author123'),
            'role' => "author",
            'profile_picture_url' => "https://i.pinimg.com/736x/f0/76/7d/f0767d1b24447d105afaa53671a98428.jpg"
        ]);

        // * Regular users
        User::factory(25)->create();
    }
}
