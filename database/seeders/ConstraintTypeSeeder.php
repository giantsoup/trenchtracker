<?php

namespace Database\Seeders;

use App\Models\ConstraintType;
use Illuminate\Database\Seeder;

class ConstraintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $constraintTypes = [
            [
                'name' => 'Faction Restriction',
                'scope' => 'faction',
                'description' => 'Restricts equipment to specific factions or excludes certain factions from using it.',
            ],
            [
                'name' => 'Unit Type Restriction',
                'scope' => 'unit_type',
                'description' => 'Restricts equipment to specific unit types (e.g., only Leaders, only Elites).',
            ],
            [
                'name' => 'Keyword Requirement',
                'scope' => 'keyword',
                'description' => 'Requires the unit to have specific keywords to use this equipment.',
            ],
            [
                'name' => 'Warband Limit',
                'scope' => 'warband_size',
                'description' => 'Limits how many of this item can be taken per warband.',
            ],
            [
                'name' => 'Equipment Exclusion',
                'scope' => 'equipment_exclusion',
                'description' => 'Prevents this equipment from being taken with certain other equipment.',
            ],
        ];

        foreach ($constraintTypes as $typeData) {
            ConstraintType::create($typeData);
        }

        $this->command->info('ConstraintTypeSeeder completed successfully!');
        $this->command->info('Created '.count($constraintTypes).' constraint types.');
    }
}
