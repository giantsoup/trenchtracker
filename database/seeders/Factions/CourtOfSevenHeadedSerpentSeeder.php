<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Court of the Seven-Headed Serpent Faction Seeder
 *
 * Seeds data for The Court of the Seven-Headed Serpent faction - aristocratic
 * heretics who serve the ancient serpentine powers with twisted nobility.
 *
 * Game Rules Version: 1.6.3
 */
class CourtOfSevenHeadedSerpentSeeder extends BaseFactionSeeder
{
    /**
     * Get faction data for The Court of the Seven-Headed Serpent
     *
     * @return array Faction data matching Faction model fillable fields
     */
    protected function getFactionData(): array
    {
        return [
            'name' => 'The Court of the Seven-Headed Serpent',
            'slug' => 'court-of-seven-headed-serpent',
            'description' => 'Aristocratic heretics who serve the ancient serpentine powers with twisted nobility.',
            'lore' => 'Once noble houses of great renown, these aristocrats have fallen to the whispers of the Seven-Headed Serpent. They maintain their courtly ways even as they serve darkness, believing that through refined evil and cultured corruption, they embody the perfect synthesis of civilization and damnation.',
            'primary_color' => '#2C3E50', // Dark Blue-Grey
            'secondary_color' => '#F39C12', // Gold
            'icon' => 'crown',
            'is_active' => true,
            'sort_order' => 4,
        ];
    }

    /**
     * Get warband variants for The Court of the Seven-Headed Serpent
     *
     * @return array Array of warband variant data
     */
    protected function getWarbandVariants(): array
    {
        return [
            [
                'name' => 'The Jade Throne Court',
                'slug' => 'jade-throne-court',
                'description' => 'Traditional aristocratic court that maintains formal hierarchy and ancient protocols.',
                'special_rules' => 'Noble units gain additional command abilities. May field Serpent Familiars.',
                'icon' => 'crown',
                'starting_resources' => [
                    'ducats' => 175,
                    'serpent_scales' => 3,
                    'noble_seals' => 2,
                ],
                'unit_restrictions' => [
                    'min_nobles' => 1,
                    'max_commoners' => 4,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['serpentine_weapons', 'courtly_armor'],
                    'preferred' => ['poison_equipment'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'The Venom Dukes',
                'slug' => 'venom-dukes',
                'description' => 'Military-focused nobles who have embraced the serpent\'s deadly gifts.',
                'special_rules' => 'All weapons gain poison effects. Enhanced stealth and ambush capabilities.',
                'icon' => 'skull',
                'starting_resources' => [
                    'ducats' => 150,
                    'venom_vials' => 5,
                    'serpent_totems' => 2,
                ],
                'unit_restrictions' => [
                    'min_assassins' => 1,
                    'max_heavy_units' => 2,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['poisoned_blades', 'venom_launchers'],
                    'banned' => ['pure_silver_weapons'],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];
    }

    /**
     * Get base units for The Court of the Seven-Headed Serpent
     *
     * @return array Array of base unit data
     */
    protected function getBaseUnits(): array
    {
        return [
            [
                'name' => 'Serpent Courtier',
                'slug' => 'serpent-courtier',
                'description' => 'Aristocratic warriors who blend noble bearing with serpentine corruption.',
                'unit_type' => 'elite',
                'role' => 'command',
                'movement' => 6,
                'melee' => 7,
                'ranged' => 5,
                'strength' => 4,
                'fortitude' => 5,
                'leadership' => 7,
                'faith' => 4,
                'base_cost' => 65,
                'upkeep_cost' => 7,
                'max_wounds' => 2,
                'min_warband_size' => 0,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'serpentine_blade',
                    'courtly_pistol',
                    'noble_armor',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['poisoned_rapier', 'serpent_whip', 'venom_dagger'],
                    'ranged_weapons' => ['dueling_pistol', 'poison_dart_gun'],
                    'armor' => ['reinforced_noble_armor', 'serpent_scale_mail'],
                    'equipment' => ['venom_vials', 'noble_seal', 'serpent_familiar'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'leadership', 'fortitude',
                ],
                'special_rules' => [
                    'noble_bearing' => 'Provides leadership bonuses to nearby units',
                    'serpent_blessing' => 'Immune to most poisons, weapons may inflict poison',
                ],
                'lore_text' => 'These fallen nobles maintain their aristocratic bearing even as they serve the ancient serpent, believing that refined corruption is the highest form of evil.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
