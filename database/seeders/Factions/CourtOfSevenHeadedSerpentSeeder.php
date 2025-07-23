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
                'name' => 'Wrath',
                'slug' => 'court-wrath',
                'description' => 'Warbands dedicated to the Serpent Head of Wrath, embodying fury and violence in their pursuit of destruction.',
                'special_rules' => 'Access to Charge of Hatred, Lesser Mark of Cain, and Blind Rage powers. Desecrated Saints provide Aura of Wrath.',
                'icon' => 'sword',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'wrath',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['wrath_powers'],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Envy',
                'slug' => 'court-envy',
                'description' => 'Warbands dedicated to the Serpent Head of Envy, coveting what others possess and stealing their advantages.',
                'special_rules' => 'Access to Envious Eyes, Coveted Position, and What is Yours is Mine powers. Desecrated Saints provide Aura of Envy.',
                'icon' => 'eye',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'envy',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['envy_powers', 'stolen_equipment'],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Pride',
                'slug' => 'court-pride',
                'description' => 'Warbands dedicated to the Serpent Head of Pride, believing themselves superior to all creation.',
                'special_rules' => 'Access to Proud Defiance, Too Proud to Fall, and Light of Samael powers. Desecrated Saints provide Aura of Pride.',
                'icon' => 'crown',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'pride',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['pride_powers'],
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Gluttony',
                'slug' => 'court-gluttony',
                'description' => 'Warbands dedicated to the Serpent Head of Gluttony, consuming everything in their path with insatiable hunger.',
                'special_rules' => 'Access to Belly of the Beast, Uncaring Gluttony, and Eater of the Flesh powers. Desecrated Saints provide Aura of Famine.',
                'icon' => 'skull',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'gluttony',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['gluttony_powers'],
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Greed',
                'slug' => 'court-greed',
                'description' => 'Warbands dedicated to the Serpent Head of Greed, hoarding wealth and power above all else.',
                'special_rules' => 'Access to Body of Gold, Black Heart, and Universal Greed powers. Desecrated Saints provide Aura of Greed.',
                'icon' => 'coins',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'greed',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['greed_powers'],
                ],
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Sloth',
                'slug' => 'court-sloth',
                'description' => 'Warbands dedicated to the Serpent Head of Sloth, warping time and space through their apathy.',
                'special_rules' => 'Access to Morphean Mind, Charm of Acedia, and Daemonium Meridianum powers. Desecrated Saints provide Aura of Sloth.',
                'icon' => 'hourglass',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'sloth',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['sloth_powers'],
                ],
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Lust',
                'slug' => 'court-lust',
                'description' => 'Warbands dedicated to the Serpent Head of Lust, corrupting flesh and spirit through forbidden desires.',
                'special_rules' => 'Access to Forbidden Pleasures, Exquisite Pain, and Call of Flesh powers. Desecrated Saints provide Aura of Lust.',
                'icon' => 'heart',
                'starting_resources' => [
                    'ducats' => 700,
                ],
                'unit_restrictions' => [
                    'deadly_sin' => 'lust',
                ],
                'equipment_restrictions' => [
                    'special_access' => ['lust_powers'],
                ],
                'is_active' => true,
                'sort_order' => 7,
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
            // NOBLES OF THE COURT
            [
                'name' => 'Praetor',
                'slug' => 'praetor',
                'description' => 'Demonic commanders and magistrates within a small corner of the fiefdom of a mighty Arch-Devil or Demon Lord.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 8,
                'melee' => 3, // +3 DICE
                'ranged' => 3, // +3 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 115,
                'upkeep_cost' => 12,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'torture_instrument', 'headtaker', 'hellblade', 'malebranche_sword'],
                    'ranged_weapons' => ['blunderbuss', 'arquebus', 'ophidian_rifle', 'pistol', 'shotgun', 'gas_grenades', 'incendiary_grenades', 'serpent_assault_gun', 'flamethrower', 'heavy_flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'unholy_trinket', 'unholy_relic', 'incendiary_ammunition', 'troop_flag', 'musical_instrument', 'crown_of_hellfire'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'strong' => 'Possesses supernatural strength',
                    'demonic_horror' => 'Causes FEAR',
                    'goetic_powers' => 'May purchase up to two GOETIC Powers or Spells (or only one if Wrath Warband)',
                    'keywords' => ['THE COURT', 'DEMONIC', 'ELITE', 'TOUGH', 'STRONG', 'FEAR', 'LEADER'],
                ],
                'lore_text' => 'Yoke devils muster at their command and Hell Knights bound to blind obedience bend their knees to these field commanders of Hell.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Sorcerer',
                'slug' => 'sorcerer',
                'description' => 'Sorcerers manipulate their own bodies to better cast the mighty spells they are charged with, floating across No Man\'s Land.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 75,
                'upkeep_cost' => 8,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'torture_instrument', 'headtaker', 'hellblade', 'malebranche_sword'],
                    'ranged_weapons' => [], // Sorcerers can only equip melee weapons
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'unholy_trinket', 'unholy_relic', 'incendiary_ammunition', 'troop_flag', 'musical_instrument', 'crown_of_hellfire'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'demonic_horror' => 'Causes FEAR',
                    'goetic_magic' => 'May purchase up to three GOETIC Spells or Powers and must purchase at least one',
                    'blessing_of_serpent_moon' => 'GOETIC (2/4/6) Spell can be cast before injury rolls to reduce damage',
                    'keywords' => ['THE COURT', 'DEMONIC', 'ELITE', 'FEAR'],
                ],
                'lore_text' => 'Their dark wisdom and cunning make them equally capable of leading one of the Court\'s warbands or acting as advisors to Praetors.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Hunter of the Left-hand Path',
                'slug' => 'hunter-left-hand-path',
                'description' => 'Followers of the Left-hand Path who stalk the primordial hinterlands of hell, hunting terrifying beasts.',
                'unit_type' => 'elite',
                'role' => 'specialist',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 2, // +2 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 110,
                'upkeep_cost' => 11,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => ['bow_of_lethe'],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'torture_instrument', 'headtaker', 'hellblade', 'malebranche_sword'],
                    'ranged_weapons' => [], // Always carries Bow of Lethe, cannot swap
                    'armor' => ['standard_armour', 'trench_shield'], // Cannot wear Infernal Armour
                    'equipment' => ['combat_helmet', 'gas_mask', 'unholy_trinket', 'unholy_relic', 'incendiary_ammunition', 'troop_flag', 'musical_instrument', 'crown_of_hellfire'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'shadow_walker' => 'GOETIC (2) Retreat ACTION without provoking free attacks',
                    'left_hand_path' => 'GOETIC (2) Spell to teleport between scenery pieces during movement',
                    'oracle_beast_cloak' => 'GOETIC (3) Once per Turn to negate injury results',
                    'keywords' => ['THE COURT', 'DEMONIC', 'ELITE', 'INFILTRATOR'],
                ],
                'lore_text' => 'They perform vile magicks and auguries, using the innards of their still-living prey to discern portents and omens.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Hell Knight',
                'slug' => 'hell-knight',
                'description' => 'The silent battalions of Hell, summoned to serve when the Court seeks sport, carrying ever-burning banners.',
                'unit_type' => 'elite',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 0, // +0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 100,
                'upkeep_cost' => 10,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => ['infernal_iron_armour'],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'torture_instrument', 'headtaker', 'hellblade', 'malebranche_sword'],
                    'ranged_weapons' => ['blunderbuss', 'arquebus', 'ophidian_rifle', 'pistol', 'shotgun', 'gas_grenades', 'incendiary_grenades', 'serpent_assault_gun', 'flamethrower', 'heavy_flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'], // Already has Infernal Iron Armour
                    'equipment' => ['combat_helmet', 'gas_mask', 'unholy_trinket', 'unholy_relic', 'incendiary_ammunition', 'troop_flag', 'musical_instrument', 'crown_of_hellfire'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'strong' => 'Possesses supernatural strength',
                    'blood_magic' => 'GOETIC (1) Spell to roll injuries with +1 DICE',
                    'goetic_powers' => 'May purchase one GOETIC Power or Spell',
                    'infernal_iron_armour' => 'Injuries rolled with -2 penalty, cannot be removed or lost',
                    'keywords' => ['THE COURT', 'DEMONIC', 'STRONG', 'ELITE'],
                ],
                'lore_text' => 'They are the bannerets of the High Lords of the Court, champions who respond to foolish mortals daring to challenge the hunting parties.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // WAR SLAVES
            [
                'name' => 'Yoke Fiend',
                'slug' => 'yoke-fiend',
                'description' => 'Seven to eight feet tall beasts with layers of shivering fat and muscle, branded by their masters and carved by Hell-Priests.',
                'unit_type' => 'troop',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 0, // +0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 30,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 12,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'torture_instrument', 'headtaker', 'hellblade'],
                    'ranged_weapons' => ['blunderbuss', 'arquebus', 'pistol', 'shotgun', 'gas_grenades'], // Only weapons costing 30 ducats or less
                    'armor' => ['standard_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'unholy_trinket', 'unholy_relic', 'incendiary_ammunition', 'musical_instrument', 'restraining_muzzle'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'hateful' => 'Must charge closest enemy without BLACK GRAIL or DEMONIC keywords within 12"',
                    'torturer' => 'Can target friendly non-DEMONIC models within 1" with melee attacks',
                    'keywords' => ['THE COURT', 'DEMONIC'],
                ],
                'lore_text' => 'They hate seeing their own reflections, as in their heart of hearts they know the beauty and glory they have lost for all eternity.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Wretched',
                'slug' => 'wretched',
                'description' => 'Unfortunate souls who possess not a drop of demon blood, acting as disposable shock troops or torture subjects.',
                'unit_type' => 'troop',
                'role' => 'infantry',
                'movement' => 6,
                'melee' => -1, // -1 DICE
                'ranged' => -1, // -1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 20,
                'upkeep_cost' => 2,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 999, // Unlimited but must be outnumbered by DEMONIC models
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe'], // Only weapons costing 10 ducats or less
                    'ranged_weapons' => ['pistol'], // Only weapons costing 10 ducats or less
                    'armor' => ['trench_shield'], // Only armor costing 10 ducats or less
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel'], // Only equipment costing 10 ducats or less
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'law_of_hell' => 'If takes ELITE model Out of Action or performs Glorious Deed, gains freedom and is removed permanently',
                    'must_be_outnumbered' => 'Warband may include any number as long as they are outnumbered by DEMONIC models',
                    'keywords' => ['THE COURT'],
                ],
                'lore_text' => 'Willing to do anything to escape their fate a million times worse than death, they grasp at the thinnest of straws.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Pit Locust',
                'slug' => 'pit-locust',
                'description' => 'Terrifying, horse-sized winged and armoured creatures with twisted faces resembling humans.',
                'unit_type' => 'beast',
                'role' => 'assault',
                'movement' => 8,
                'melee' => 2, // +2 DICE
                'ranged' => 0, // +0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 90,
                'upkeep_cost' => 9,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => ['reinforced_armour'],
                'equipment_options' => [
                    'melee_weapons' => [], // Fights with natural weapons, no penalties for fighting unarmed
                    'ranged_weapons' => [],
                    'armor' => [], // Already has Reinforced Armour, cannot have other armor
                    'equipment' => ['crown_of_hellfire'], // Only equipment they can have
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'swarming_attack' => 'Additional stinger attack if charged, first attack has SHRAPNEL keyword',
                    'demonic_horror' => 'Causes FEAR',
                    'flying' => 'Can fly over terrain and models',
                    'no_unarmed_penalties' => 'Suffers no penalties for fighting unarmed',
                    'keywords' => ['THE COURT', 'DEMONIC', 'FEAR'],
                ],
                'lore_text' => 'They fight with rending blades attached to their limbs and with poison stingers, their clatter heralding the coming of the Court.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Desecrated Saint',
                'slug' => 'desecrated-saint',
                'description' => 'The most prized possessions of the Lords of Hell: men and women once destined to become saints but led astray.',
                'unit_type' => 'elite',
                'role' => 'support',
                'movement' => 6,
                'melee' => 3, // +3 DICE
                'ranged' => 0, // N/A
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 140,
                'upkeep_cost' => 14,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => ['cocytus_armour'],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'torture_instrument', 'headtaker', 'hellblade', 'malebranche_sword'], // Can carry up to 3, only 1 two-handed
                    'ranged_weapons' => [], // Cannot use ranged weapons
                    'armor' => [], // Already has Cocytus Armour, cannot be removed
                    'equipment' => [],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'demonic_horror' => 'Causes FEAR',
                    'strong' => 'Possesses supernatural strength',
                    'three_arms' => 'Can carry up to three melee weapons, make one attack per weapon per activation',
                    'cocytus_armour' => 'Nigh-impregnable armor reflected in profile, cannot be removed or lost',
                    'demonic_aura' => 'Provides aura effect based on warband\'s Deadly Sin dedication',
                    'keywords' => ['THE COURT', 'DEMONIC', 'FEAR', 'TOUGH', 'STRONG'],
                ],
                'lore_text' => 'Blasphemous creations of Hell that act as unholy war altars, polluting and perverting the land they travel over.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
