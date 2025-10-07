<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProfileSeeder::class,
            AddressSeeder::class,
            UserSeeder::class,
            AbilitySeeder::class,
            ProfileAbilitySeeder::class,
            UserProfileSeeder::class,
            ElectionTypeSeeder::class,
            CandidateTypeSeeder::class,
        ]);
    }
}
