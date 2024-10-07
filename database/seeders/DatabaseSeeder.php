<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $namas = [
            'Tauriq',
            'Shofi',
            'Aditya',
            'Valentino',
            'Gilang',
            'Agi',
            'Robit',
            'Valerian',
            'Rojaq',
            'Riyansyah',
            'Fakhri',
            'Ferdi',
            'Alfa',
            'Reza',
            'Fazri',
            'Choirul',
            'Angga',
            'Nazril',
            'Syarif',
            'Ivan',
            'Gerrard',
            'Hanief',
            'Adam',
            'Bayu',
            'Devino',
            'Jane',
            'Rizki',
            'Zaid',
            'Faiz',
            'Fajar',
            'Ridwan'
        ];

        foreach ($namas as $name) {
            DB::table('namas')->insert([
                'nama' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
