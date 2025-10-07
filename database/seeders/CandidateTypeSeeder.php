<?php

namespace Database\Seeders;

use App\Models\CandidateType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CandidateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Lista de municípios da Bahia com seus códigos IBGE
            $candidateTypes = [
                ['description' => 'PRESIDENTE'],
                ['description' => 'GOVERNADOR'],
                ['description' => 'SENADOR'],
                ['description' => 'DEPIUTADO FEDERAL'],
                ['description' => 'DEPIUTADO ESTADUAL'],
                ['description' => 'PREFEITO'],
                ['description' => 'VEREADOR'],
            ];

            foreach ($candidateTypes as $candidateType) {
                CandidateType::firstOrCreate([
                    'description' => $candidateType['description'],
                ]);
            }
    }
}
