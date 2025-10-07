<?php

namespace Database\Seeders;

use App\Models\ElectionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ElectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Lista de municípios da Bahia com seus códigos IBGE
            $electionTypes = [
                ['description' => 'PRESIDENCIAL'],
                ['description' => 'ESTADUAL'],
                ['description' => 'MUNICIPAL'],
            ];

            foreach ($electionTypes as $electionType) {
                ElectionType::firstOrCreate([
                    'description' => $electionType['description'],
                ]);
            }
    }
}
