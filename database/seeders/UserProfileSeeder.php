<?php

namespace Database\Seeders;

use App\Models\UserProfiles;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'user_id' => 1,
                'profile_id' => 1,
            ],
            [
                'user_id' => 1,
                'profile_id' => 2,
            ],
            [
                'user_id' => 2,
                'profile_id' => 2,
            ],
        ];
        foreach ($profiles as $value) {
            UserProfiles::firstOrCreate([
                'user_id'    => $value['user_id'],
                'profile_id' => $value['profile_id'],
            ]);
        }
    }
}
