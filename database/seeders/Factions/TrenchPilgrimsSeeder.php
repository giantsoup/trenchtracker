<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Trench Pilgrims Faction Seeder
 *
 * Seeds data for The Trench Pilgrims faction - faithful warriors of Heaven
 * fighting to reclaim the world from the forces of Hell.
 *
 * Game Rules Version: 1.6.3
 */
class TrenchPilgrimsSeeder extends BaseFactionSeeder
{
    /**
     * Get faction data for The Trench Pilgrims
     *
     * @return array Faction data matching Faction model fillable fields
     */
    protected function getFactionData(): array
    {
        return [
            'name' => 'The Trench Pilgrims',
            'slug' => 'trench-pilgrims',
            'description' => 'The faithful warriors of Heaven, fighting to reclaim the world from the forces of Hell.',
            'lore' => 'These devoted soldiers march into the trenches with prayer on their lips and faith in their hearts. They believe that through sacrifice and devotion, they can turn the tide of this endless war.',
            'primary_color' => '#D4AF37', // Gold
            'secondary_color' => '#FFFFFF', // White
            'icon' => 'cross',
            'is_active' => true,
            'sort_order' => 1,
        ];
    }

    /**
     * Get warband variants for The Trench Pilgrims
     *
     * @return array Array of warband variant data
     */
    protected function getWarbandVariants(): array
    {
        return [
            [
                'name' => 'Orthodox Brotherhood',
                'slug' => 'orthodox-brotherhood',
                'description' => 'Traditional Trench Pilgrims following orthodox doctrine and tactics.',
                'special_rules' => 'Units gain +1 DICE to Faith-based tests. May recruit Chaplains.',
                'icon' => 'cross-circle',
                'starting_resources' => [
                    'ducats' => 150,
                    'relics' => 1,
                    'blessing_tokens' => 3,
                ],
                'unit_restrictions' => [
                    'max_heretics' => 0,
                    'min_faithful' => 3,
                ],
                'equipment_restrictions' => [
                    'banned' => ['cursed_weapons'],
                    'special_access' => ['blessed_ammunition'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Penitent Company',
                'slug' => 'penitent-company',
                'description' => 'Reformed sinners seeking redemption through battle.',
                'special_rules' => 'Units may gain Experience faster but start with reduced stats.',
                'icon' => 'flame',
                'starting_resources' => [
                    'ducats' => 120,
                    'penitence_markers' => 5,
                ],
                'unit_restrictions' => [
                    'max_elite_units' => 2,
                ],
                'equipment_restrictions' => [
                    'limited' => ['heavy_armor'],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];
    }

    /**
     * Get base units for The Trench Pilgrims
     *
     * @return array Array of base unit data
     */
    protected function getBaseUnits(): array
    {
        return [
            [
                'name' => 'Trench Pilgrim',
                'slug' => 'trench-pilgrim',
                'description' => 'Faithful soldiers of the Church, equipped for brutal trench warfare.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 5,
                'melee' => 6,
                'ranged' => 5,
                'strength' => 4,
                'fortitude' => 4,
                'leadership' => 6,
                'faith' => 7,
                'base_cost' => 45,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 10,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'trench_gun',
                    'bayonet',
                    'trench_armor',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['trench_club', 'blessed_blade', 'chain_weapon'],
                    'ranged_weapons' => ['pistol', 'rifle', 'shotgun'],
                    'armor' => ['reinforced_armor', 'blessed_armor'],
                    'equipment' => ['grenades', 'medical_supplies', 'holy_water'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'faith',
                ],
                'special_rules' => [
                    'faithful' => 'May spend Blessing markers on faith-based tests',
                    'trench_fighter' => '+1 DICE when fighting in cover',
                ],
                'lore_text' => 'The backbone of the Church\'s forces, these battle-hardened pilgrims have sworn sacred oaths to reclaim the Holy Land from the forces of darkness.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
