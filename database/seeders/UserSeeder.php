<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'ADMINISTRADOR GERAL',
                'cpf' => '90211928534',
                'email' => 'geison.santos@saude.ba.gov.br',
                'profile_id' => '1',
                'address_id' => '1',
                'password' => '123456',
                // 'password' => Hash::make('geral763'),
            ],
            [
                'name' => 'Develop',
                'cpf' => '12312312387',
                'email' => 'develop@saude.ba.gov.br',
                'profile_id' => '2',
                'address_id' => '1',
                'password' => '123456',
                // 'password' => Hash::make('develop763'),
            ],
        ];
        foreach ($users as $value) {
            User::firstOrCreate([
                'name' => $value['name'],
                'cpf' => $value['cpf'],
                'email' => $value['email'],
                'profile_id' => $value['profile_id'],
                'address_id' => $value['address_id'],
                'password' => $value['password'],
            ]);
        }
    }
}
