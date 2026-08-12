<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        // Pendaftaran Akun Administrator Utama
        User::create([
            'name'     => 'Admin BioLink',
            'email'    => 'admin@biolink.com',
            'password' => Hash::make('password123'), // Enkripsi hashing Bcrypt / Argon2
        ]);
    }
}
