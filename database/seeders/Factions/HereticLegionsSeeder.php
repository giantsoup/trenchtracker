<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Heretic Legions Faction Seeder
 *
 * Seeds data for the Heretic Legions faction - corrupted souls who have
 * embraced the darkness and fight for the infernal powers.
 *
 * Game Rules Version: 1.6.3
 */
class HereticLegionsSeeder extends BaseFactionSeeder
{
    /**
     * Get faction data for Heretic Legions
     *
     * @return array Faction data matching Faction model fillable fields
     */
    protected function getFactionData(): array
    {
        return [
            'name' => 'Heretic Legions',
            'slug' => 'heretic-legions',
            'description' => 'Corrupted souls who have embraced the darkness and fight for the infernal powers.',
            'lore' => 'Once faithful servants of the divine, these warriors have been twisted by exposure to Hell\'s influence. They now serve dark masters with fanatical devotion.',
            'primary_color' => '#8B0000', // Dark Red
            'secondary_color' => '#000000', // Black
            'icon' => 'pentagram',
            'is_active' => true,
            'sort_order' => 2,
        ];
    }

    /**
     * Get warband variants for Heretic Legions
     *
     * @return array Array of warband variant data
     */
    protected function getWarbandVariants(): array
    {
        return [
            [
                'name' => 'Infernal Cult',
                'slug' => 'infernal-cult',
                'description' => 'Devoted servants of specific demonic entities.',
                'special_rules' => 'May summon Lesser Demons. Units immune to Fear from Infernal sources.',
                'icon' => 'flame-kindling',
                'starting_resources' => [
                    'ducats' => 130,
                    'soul_tokens' => 2,
                    'ritual_components' => 3,
                ],
                'unit_restrictions' => [
                    'min_cultists' => 2,
                    'max_redeemed' => 1,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['demonic_weapons', 'cursed_armor'],
                    'banned' => ['blessed_items'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];
    }

    /**
     * Get base units for Heretic Legions
     *
     * @return array Array of base unit data
     */
    protected function getBaseUnits(): array
    {
        return [
            [
                'name' => 'Heretic Legionnaire',
                'slug' => 'heretic-legionnaire',
                'description' => 'Corrupted soldiers who have turned from the light.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 5,
                'melee' => 6,
                'ranged' => 5,
                'strength' => 4,
                'fortitude' => 4,
                'leadership' => 5,
                'faith' => 3,
                'base_cost' => 40,
                'upkeep_cost' => 4,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 10,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'corrupted_rifle',
                    'combat_knife',
                    'tattered_armor',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['chainsword', 'cursed_blade', 'daemon_weapon'],
                    'ranged_weapons' => ['autopistol', 'hellgun', 'flamer'],
                    'armor' => ['chaos_armor', 'daemonic_hide'],
                    'equipment' => ['frag_grenades', 'combat_drugs', 'ritual_components'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership',
                ],
                'special_rules' => [
                    'corrupted' => 'Immune to certain divine effects',
                    'fanatical' => 'May ignore certain morale effects',
                ],
                'lore_text' => 'Once faithful soldiers, these warriors have been corrupted by exposure to infernal influences and now serve the dark powers with twisted devotion.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
