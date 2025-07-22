<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Cult of the Black Grail Faction Seeder
 *
 * Seeds data for The Cult of the Black Grail faction - dark devotees who seek
 * forbidden knowledge through corrupted sacraments and unholy rituals.
 *
 * Game Rules Version: 1.6.3
 */
class CultOfTheBlackGrailSeeder extends BaseFactionSeeder
{
    /**
     * Get faction data for The Cult of the Black Grail
     *
     * @return array Faction data matching Faction model fillable fields
     */
    protected function getFactionData(): array
    {
        return [
            'name' => 'The Cult of the Black Grail',
            'slug' => 'cult-of-the-black-grail',
            'description' => 'Dark devotees who seek forbidden knowledge through corrupted sacraments and unholy rituals.',
            'lore' => 'These heretics have perverted the sacred chalice into an instrument of damnation. They consume cursed wine and perform blasphemous rites, believing that through corruption they will achieve transcendence. Their grail overflows with the blood of the innocent and the tears of the damned.',
            'primary_color' => '#4A0E2B', // Dark Wine
            'secondary_color' => '#C0392B', // Dark Red
            'icon' => 'wine-glass',
            'is_active' => true,
            'sort_order' => 3,
        ];
    }

    /**
     * Get warband variants for The Cult of the Black Grail
     *
     * @return array Array of warband variant data
     */
    protected function getWarbandVariants(): array
    {
        return [
            [
                'name' => 'The Blood Chalice Covenant',
                'slug' => 'blood-chalice-covenant',
                'description' => 'Orthodox followers of the Black Grail who practice the most ancient rituals.',
                'special_rules' => 'May consume Blood Markers to enhance abilities. Immune to certain psychological effects.',
                'icon' => 'wine-glass',
                'starting_resources' => [
                    'ducats' => 125,
                    'corrupted_relics' => 1,
                    'blood_vials' => 4,
                ],
                'unit_restrictions' => [
                    'min_acolytes' => 2,
                    'max_pure_units' => 1,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['ritual_daggers', 'unholy_chalices'],
                    'banned' => ['holy_water', 'blessed_symbols'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'The Crimson Libation',
                'slug' => 'crimson-libation',
                'description' => 'Extremist sect that practices blood communion and flesh sacrifice.',
                'special_rules' => 'Units regenerate health by consuming enemy blood. Enhanced combat abilities after kills.',
                'icon' => 'droplet',
                'starting_resources' => [
                    'ducats' => 110,
                    'sacrificial_knives' => 3,
                    'communion_wine' => 2,
                ],
                'unit_restrictions' => [
                    'min_blood_priests' => 1,
                    'max_ranged_units' => 3,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['vampiric_weapons', 'blood_armor'],
                    'preferred' => ['melee_weapons'],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];
    }

    /**
     * Get base units for The Cult of the Black Grail
     *
     * @return array Array of base unit data
     */
    protected function getBaseUnits(): array
    {
        return [
            [
                'name' => 'Black Grail Acolyte',
                'slug' => 'black-grail-acolyte',
                'description' => 'Devoted cultists who have embraced the dark sacraments of the Black Grail.',
                'unit_type' => 'trooper',
                'role' => 'support',
                'movement' => 5,
                'melee' => 5,
                'ranged' => 4,
                'strength' => 3,
                'fortitude' => 4,
                'leadership' => 5,
                'faith' => 2,
                'base_cost' => 35,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 8,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'ritual_dagger',
                    'unholy_symbol',
                    'cultist_robes',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['sacrificial_blade', 'cursed_flail', 'blood_whip'],
                    'ranged_weapons' => ['crossbow', 'throwing_knives'],
                    'armor' => ['reinforced_robes', 'blood_armor'],
                    'equipment' => ['blood_vials', 'ritual_components', 'unholy_chalice'],
                ],
                'stat_advancement_options' => [
                    'melee', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'blood_ritual' => 'May perform blood rituals to gain temporary bonuses',
                    'corrupted_faith' => 'Uses corrupted faith instead of pure faith',
                ],
                'lore_text' => 'These devoted cultists have forsaken the light in favor of the dark promises of the Black Grail, believing that through corruption they will find transcendence.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
