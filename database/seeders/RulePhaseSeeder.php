<?php

namespace Database\Seeders;

use App\Models\RulePhase;
use Illuminate\Database\Seeder;

class RulePhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phases = [
            [
                'name' => 'Movement',
                'slug' => 'movement',
                'sort_order' => 1,
                'description' => 'Rules governing unit movement during the Movement phase',
            ],
            [
                'name' => 'Shooting',
                'slug' => 'shooting',
                'sort_order' => 2,
                'description' => 'Rules for ranged combat and shooting attacks',
            ],
            [
                'name' => 'Melee',
                'slug' => 'melee',
                'sort_order' => 3,
                'description' => 'Rules for close combat and melee engagements',
            ],
            [
                'name' => 'Campaign',
                'slug' => 'campaign',
                'sort_order' => 4,
                'description' => 'Rules for campaign progression, experience, and warband management',
            ],
            [
                'name' => 'Special Rules',
                'slug' => 'special-rules',
                'sort_order' => 5,
                'description' => 'Special rules, keywords, and unique mechanics',
            ],
        ];

        foreach ($phases as $phaseData) {
            RulePhase::updateOrCreate(
                ['slug' => $phaseData['slug']],
                $phaseData
            );
        }
    }
}
