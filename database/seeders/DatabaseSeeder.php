<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Example User
        User::firstOrCreate(
    ['email' => 'test@example.com'], // unique column
    [
        'name' => 'Test User',
        'password' => bcrypt('password'), // you can set a default password
    ]
);


        // Call other seeders
        $this->call([
            ExerciseCategorySeeder::class,
            TipSeeder::class,
        ]);
    }
}
