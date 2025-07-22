<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Principality of New Antioch Faction Seeder
 *
 * Seeds data for The Principality of New Antioch faction - survivors of the
 * old world who have adapted unique tactics for the new reality.
 *
 * Game Rules Version: 1.6.3
 */
class PrincipalityOfNewAntiochSeeder extends BaseFactionSeeder
{
    /**
     * Get faction data for The Principality of New Antioch
     *
     * @return array Faction data matching Faction model fillable fields
     */
    protected function getFactionData(): array
    {
        return [
            'name' => 'The Principality of New Antioch',
            'slug' => 'principality-of-new-antioch',
            'description' => 'Survivors of the old world who have adapted unique tactics for the new reality.',
            'lore' => 'The remnants of ancient Antioch have evolved into something new, blending old traditions with harsh necessities of the eternal war.',
            'primary_color' => '#2E8B57', // Sea Green
            'secondary_color' => '#F5F5DC', // Beige
            'icon' => 'shield',
            'is_active' => true,
            'sort_order' => 6,
        ];
    }

    /**
     * Get warband variants for The Principality of New Antioch
     *
     * @return array Array of warband variant data
     */
    protected function getWarbandVariants(): array
    {
        return [
            [
                'name' => 'Survivor Enclave',
                'slug' => 'survivor-enclave',
                'description' => 'Hardened survivors who have adapted to the harsh realities of endless war.',
                'special_rules' => 'Units gain bonuses when fighting in ruins or trenches. Improved scavenging.',
                'icon' => 'tent',
                'starting_resources' => [
                    'ducats' => 140,
                    'scavenged_gear' => 4,
                    'survival_supplies' => 3,
                ],
                'unit_restrictions' => [
                    'max_nobles' => 0,
                    'min_veterans' => 2,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['scavenged_weapons', 'makeshift_armor'],
                    'limited' => ['pristine_equipment'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];
    }

    /**
     * Get base units for The Principality of New Antioch
     *
     * @return array Array of base unit data
     */
    protected function getBaseUnits(): array
    {
        return [
            [
                'name' => 'Antioch Survivor',
                'slug' => 'antioch-survivor',
                'description' => 'Hardened veterans who have endured the worst the war has to offer.',
                'unit_type' => 'trooper',
                'role' => 'versatile',
                'movement' => 6,
                'melee' => 6,
                'ranged' => 6,
                'strength' => 4,
                'fortitude' => 5,
                'leadership' => 5,
                'faith' => 5,
                'base_cost' => 50,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 8,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'scavenged_rifle',
                    'survival_knife',
                    'patched_armor',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['makeshift_club', 'salvaged_sword', 'trench_tool'],
                    'ranged_weapons' => ['hunting_rifle', 'crossbow', 'sling'],
                    'armor' => ['reinforced_clothing', 'scrap_armor'],
                    'equipment' => ['medical_supplies', 'survival_gear', 'scavenged_parts'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'fortitude', 'leadership',
                ],
                'special_rules' => [
                    'survivor' => 'Gains bonuses when fighting in difficult terrain',
                    'resourceful' => 'Can make use of improvised equipment more effectively',
                ],
                'lore_text' => 'These battle-hardened survivors have learned to make the most of whatever they can find, turning scraps and ruins into tools of war.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
