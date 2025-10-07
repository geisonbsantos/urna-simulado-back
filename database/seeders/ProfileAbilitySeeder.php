<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\ProfileAbility;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProfileAbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | The admin profile have all the skills
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= sizeof(Ability::all()); $i++) {
            ProfileAbility::insert([
                'profile_id' => 1,
                'ability_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        // NOTE - USUÁRIO DO SISTEMA
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 2,
            'ability_id' => 16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        // NOTE - ELEITOR DO SISTEMA
        ProfileAbility::insert([
            'profile_id' => 3,
            'ability_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 3,
            'ability_id' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 3,
            'ability_id' => 11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 3,
            'ability_id' => 13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 3,
            'ability_id' => 14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 3,
            'ability_id' => 16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        // NOTE - CANDIDATO DO SISTEMA
        ProfileAbility::insert([
            'profile_id' => 4,
            'ability_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 4,
            'ability_id' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 4,
            'ability_id' => 11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 4,
            'ability_id' => 16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProfileAbility::insert([
            'profile_id' => 4,
            'ability_id' => 17,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
