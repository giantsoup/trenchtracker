<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Iron Sultanate Faction Seeder
 *
 * Seeds data for the Iron Sultanate faction - technologically advanced forces
 * wielding steam-powered war machines and industrial might.
 *
 * Game Rules Version: 1.6.3
 */
class IronSultanateSeeder extends BaseFactionSeeder
{
    /**
     * Get faction data for Iron Sultanate
     *
     * @return array Faction data matching Faction model fillable fields
     */
    protected function getFactionData(): array
    {
        return [
            'name' => 'Iron Sultanate',
            'slug' => 'iron-sultanate',
            'description' => 'Technologically advanced forces wielding steam-powered war machines.',
            'lore' => 'Masters of industry and innovation, the Iron Sultanate has adapted to the endless war with mechanical precision and technological superiority.',
            'primary_color' => '#4682B4', // Steel Blue
            'secondary_color' => '#FFD700', // Gold
            'icon' => 'gear',
            'is_active' => true,
            'sort_order' => 5,
        ];
    }

    /**
     * Get warband variants for Iron Sultanate
     *
     * @return array Array of warband variant data
     */
    protected function getWarbandVariants(): array
    {
        return [
            [
                'name' => 'Mechanized Division',
                'slug' => 'mechanized-division',
                'description' => 'Heavy emphasis on steam-powered war machines and technology.',
                'special_rules' => 'Reduced equipment malfunction penalties. May field additional vehicles.',
                'icon' => 'cog',
                'starting_resources' => [
                    'ducats' => 200,
                    'scrap_metal' => 5,
                    'steam_cores' => 2,
                ],
                'unit_restrictions' => [
                    'min_engineers' => 1,
                    'max_cavalry' => 1,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['advanced_firearms', 'steam_armor'],
                    'preferred' => ['mechanical_equipment'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];
    }

    /**
     * Get base units for Iron Sultanate
     *
     * @return array Array of base unit data
     */
    protected function getBaseUnits(): array
    {
        return [
            [
                'name' => 'Steam Engineer',
                'slug' => 'steam-engineer',
                'description' => 'Skilled technicians who maintain and operate the Sultanate\'s mechanical wonders.',
                'unit_type' => 'specialist',
                'role' => 'support',
                'movement' => 5,
                'melee' => 5,
                'ranged' => 6,
                'strength' => 4,
                'fortitude' => 5,
                'leadership' => 6,
                'faith' => 5,
                'base_cost' => 55,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 4,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'steam_rifle',
                    'engineer_tools',
                    'reinforced_coat',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['steam_hammer', 'mechanical_wrench', 'powered_blade'],
                    'ranged_weapons' => ['advanced_rifle', 'steam_pistol', 'pressure_gun'],
                    'armor' => ['steam_armor', 'reinforced_gear'],
                    'equipment' => ['repair_kit', 'steam_core', 'mechanical_familiar'],
                ],
                'stat_advancement_options' => [
                    'ranged', 'fortitude', 'leadership', 'strength',
                ],
                'special_rules' => [
                    'mechanical_expertise' => 'Can repair and enhance mechanical equipment',
                    'steam_powered' => 'Equipment gains enhanced performance with steam cores',
                ],
                'lore_text' => 'These skilled engineers are the backbone of the Iron Sultanate\'s technological superiority, maintaining the complex machinery that gives them their edge in battle.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
