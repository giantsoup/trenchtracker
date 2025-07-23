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
                'name' => 'Fida\'i of Alamut',
                'slug' => 'fidai-of-alamut',
                'description' => 'The Cabal of Assassins - deadly bands dispatched by the Old Man of the Mountain on secret missions, led by a Master Assassin with fully-trained members of the Order.',
                'special_rules' => 'Flock of Assassins: Can have up to three Assassins including Master Assassin. Master Assassin has TOUGH keyword and costs 95 ducats. Assassin Acolytes: Up to three Azebs can gain INFILTRATOR for +10 ducats each. Alamut Alone: Cannot include Yüzbaşı, Alchemist, Janissaries, Lions of Jabir or Brazen Bulls. Killing Squad: May have single Fireteam of any two models. Dervishes: May include up to four Dervishes (Janissary stats but cannot use Reinforced Armour, have Whirling Dervishes special rule instead of STRONG).',
                'icon' => 'user-x',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'max_assassins' => 3,
                    'must_include_master_assassin' => true,
                    'max_assassin_acolytes' => 3,
                    'no_yuzbasi' => true,
                    'no_alchemist' => true,
                    'no_janissaries' => true,
                    'no_lions_of_jabir' => true,
                    'no_brazen_bulls' => true,
                    'max_dervishes' => 4,
                    'max_fireteams' => 1,
                ],
                'equipment_restrictions' => [
                    'master_assassin_cost' => 95,
                    'assassin_acolyte_infiltrator_cost' => 10,
                    'dervishes_no_reinforced_armour' => true,
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'House of Wisdom',
                'slug' => 'house-of-wisdom',
                'description' => 'The pre-eminent centre of learning within the Iron Sultanate. Alchemists dispatch expeditions to seek lost knowledge, capture enemy beasts, or eliminate Heretic Alchemists.',
                'special_rules' => 'Alchemists: May have up to two Alchemists, must include at least one. Alchemist Armour LIMIT becomes 2. Pride of Jabir: May include up to three Lions of Jabir. Private Venture: Cannot include Azebs, Janissaries, Yüzbaşı or Assassins. Noble Guardians: May include up to two Fāris (Janissary stats with ELITE and STRONG keywords). Kavass: Use Azeb stats but cannot buy SKIRMISHER, up to three can increase Melee to +0D for +5 ducats each. Weapon Collections: Choose two weapons from New Antioch or Trench Pilgrims armouries not in Iron Sultanate list.',
                'icon' => 'book-open',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'min_alchemists' => 1,
                    'max_alchemists' => 2,
                    'max_lions_of_jabir' => 3,
                    'no_azebs' => true,
                    'no_janissaries' => true,
                    'no_yuzbasi' => true,
                    'no_assassins' => true,
                    'max_faris' => 2,
                    'max_kavass_melee_upgrades' => 3,
                ],
                'equipment_restrictions' => [
                    'alchemist_armour_limit' => 2,
                    'kavass_no_skirmisher' => true,
                    'kavass_melee_upgrade_cost' => 5,
                    'foreign_weapon_collections' => 2,
                ],
                'is_active' => true,
                'sort_order' => 2,
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
            // SULTAN'S ELITE
            [
                'name' => 'Yüzbaşı Captain',
                'slug' => 'yuzbasi-captain',
                'description' => 'Military expedition commanders who lead from the front. Their selection is solely on merit, with no consideration given to family pedigree or wealth.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 2, // +2 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 70,
                'upkeep_cost' => 7,
                'max_wounds' => 1,
                'min_warband_size' => 1,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'machine_gun', 'flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet', 'troop_flag', 'binoculars', 'holy_relic', 'cloak_of_alamut'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'mubarizun' => 'Immune to FEAR effects and add +1 DICE to injury rolls against TOUGH opponents',
                    'keywords' => ['ELITE', 'SULTANATE', 'TOUGH', 'LEADER'],
                ],
                'lore_text' => 'Field officers expected to lead from the front, selected amongst the very best soldiers of the Sultanate with bodies hardened against injury by Jabirean arts.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Jabirean Alchemist',
                'slug' => 'jabirean-alchemist',
                'description' => 'Master of esoteric powers, able to control fire and ice, metal and liquid. Creates intricate mechanical devices and weapons of calamitous potency.',
                'unit_type' => 'elite',
                'role' => 'specialist',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 2, // +2 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 55,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'incendiary_grenades', 'machine_gun', 'flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'alchemist_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet', 'binoculars', 'holy_relic', 'cloak_of_alamut'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'mastery_of_elements' => 'At battle start, assign SHRAPNEL, FIRE or GAS keyword to all weapons. Can change with RISKY ACTION +1 DICE',
                    'keywords' => ['ELITE', 'SULTANATE'],
                ],
                'lore_text' => 'In exchange for freedom to practise their arts, Alchemists supply the Sultanate with peerless battle lions and serve on front lines with devastating alchemical compounds.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Sultanate Assassin',
                'slug' => 'sultanate-assassin',
                'description' => 'Legendary mystic warriors able to bend space and time using sacred rituals and powerful hallucinogens, prowling behind enemy lines with merciless efficiency.',
                'unit_type' => 'elite',
                'role' => 'specialist',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 85,
                'upkeep_cost' => 9,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'assassins_dagger'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'machine_gun', 'flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet', 'binoculars', 'holy_relic', 'cloak_of_alamut'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'time_slip' => 'If any attack misses, may move into any unoccupied space within 6" without provoking free attacks',
                    'temporal_assassin' => 'After charge roll, may split through time to attack up to two enemies within charging distance',
                    'infiltrator' => 'Deploy anywhere out of line of sight, at least 8" from closest enemy',
                    'keywords' => ['ELITE', 'SULTANATE', 'INFILTRATOR'],
                ],
                'lore_text' => 'Whispered about the world over for their secrecy and ruthlessness, they can seemingly appear in two places simultaneously and travel back in time to avoid retaliation.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // THOSE WHO BELIEVE
            [
                'name' => 'Azeb',
                'slug' => 'azeb',
                'description' => 'Soldiers recruited from the provinces where every house in twenty provides a warrior. Used as light skirmishers to harass enemies while heavier troops close in.',
                'unit_type' => 'troop',
                'role' => 'infantry',
                'movement' => 6,
                'melee' => -1, // -1 DICE
                'ranged' => 0, // 0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 25,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 12,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'musket', 'pistol', 'shotgun', 'grenades', 'flamethrower'],
                    'armor' => ['standard_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'musicians_instrument', 'wind_amulet'],
                    'upgrades' => ['skirmisher_upgrade'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'skirmisher_option' => 'Can be converted to SKIRMISHER for +5 ducats. When charged, can move D3" in any direction before charger moves',
                    'keywords' => ['SULTANATE'],
                ],
                'lore_text' => 'The backbone of the Sultan\'s forces, these provincial warriors serve with dedication despite their humble origins and basic training.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Sultanate Sapper',
                'slug' => 'sultanate-sapper',
                'description' => 'Highly respected specialists who man the great cannons of the Iron Wall. Easily identified by terrible burns from overheating artillery.',
                'unit_type' => 'specialist',
                'role' => 'support',
                'movement' => 6,
                'melee' => 0, // +0 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 50,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 2,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => ['shovel'],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'musket', 'pistol', 'shotgun', 'alaybozan', 'grenades', 'flamethrower'],
                    'armor' => ['standard_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'mine_setting' => 'ACTION +2 DICE to mine terrain piece up to 8"x8". Triggers on contact with SHRAPNEL damage',
                    'de_mine' => 'RISKY ACTION to disable mines. If failed, mine explodes',
                    'forward_positions' => 'Can deploy up to 6" from deployment zone in contact with scenery',
                    'fortify' => 'RISKY ACTION +1 DICE to gain Cover until model moves',
                    'keywords' => ['SULTANATE'],
                ],
                'lore_text' => 'These battle-scarred veterans of the Iron Wall\'s artillery are masters of explosives and fortification, essential for both offense and defense.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Lion of Jabir',
                'slug' => 'lion-of-jabir',
                'description' => 'Unique alchemical masterworks grown by Jabirean scientists. Each takes many forms with speed and ferocity nearly unmatched, some with strange powers.',
                'unit_type' => 'beast',
                'role' => 'assault',
                'movement' => 8,
                'melee' => 1, // +1 DICE
                'ranged' => 0, // NA
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 60,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 2,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'armor' => ['standard_armour', 'reinforced_armour'],
                    'equipment' => ['wind_amulet'],
                    'upgrades' => ['fierce_lion_upgrade'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    'artificial_body' => 'All injury rolls made with -1 DICE due to lack of vital organs',
                    'mauling' => 'Downed opponents on bases smaller than 40mm cannot stand up while in melee with Lion',
                    'lions_grace' => 'Add +1 DICE to Dash/Jump/Climb/Diving Charge ACTIONS',
                    'fierce_option' => 'Can upgrade to Fierce Lion for +5 ducats to ignore FEAR effects',
                    'keywords' => ['SULTANATE'],
                ],
                'lore_text' => 'Named after deadly hunters of the plains, these alchemical creations are masterworks of Jabirean science, each unique in form and capability.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Janissary',
                'slug' => 'janissary',
                'description' => 'Elite warriors raised from childhood in the arts of war. Excel at devastating counter-charges and act as bodyguards for high-ranking individuals.',
                'unit_type' => 'elite',
                'role' => 'infantry',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 55,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 6,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'machine_gun', 'flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'strong' => 'Ignore HEAVY keyword effects on weapons',
                    'counter_charge' => 'If first ACTION is Charge, add +1 DICE to subsequent Melee Attack ACTIONS this activation',
                    'keywords' => ['SULTANATE', 'STRONG'],
                ],
                'lore_text' => 'Captured during raids and subjected to rigorous training from childhood, these elite warriors form the backbone of the Sultan\'s military might.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Brazen Bull',
                'slug' => 'brazen-bull',
                'description' => 'Monstrous being of immense power capable of tearing devils in half. Equipped with heavy artillery that even superhuman Janissaries cannot lift.',
                'unit_type' => 'monster',
                'role' => 'heavy',
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
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['titan_zulfiqar'],
                    'ranged_weapons' => ['murad_bombard', 'flame_cannon'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'marid_shovel', 'mountaineer_kit', 'medi_kit', 'wind_amulet'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'strong' => 'Ignore HEAVY keyword effects on weapons',
                    'artificial_body' => 'All injury rolls made with -1 DICE due to lack of vital organs',
                    'trample' => 'Once per activation, extra Melee Attack ACTION against Downed enemy on 32mm or smaller base, ignores armour',
                    'terrifying' => 'Causes FEAR in enemies',
                    'heavy_weapons_only' => 'Can only use weapons with HEAVY keyword, can carry up to two Brazen Bull Only weapons',
                    'keywords' => ['SULTANATE', 'FEAR', 'TOUGH', 'STRONG'],
                ],
                'lore_text' => 'These alchemical monstrosities are living siege engines, capable of wielding the heaviest weapons and crushing enemies beneath their massive bulk.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // VARIANT-SPECIFIC UNITS
            [
                'name' => 'Master Assassin',
                'slug' => 'master-assassin',
                'description' => 'One of the deadly Hands of Alamut, leading Fida\'i expeditions with unmatched skill and the blessing of the Old Man of the Mountain.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 95,
                'upkeep_cost' => 10,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe', 'assassins_dagger', 'golden_khanjar'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'machine_gun', 'flamethrower', 'bow_of_alamut'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet', 'binoculars', 'holy_relic', 'cloak_of_alamut', 'hashashin_leaf'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'time_slip' => 'If any attack misses, may move into any unoccupied space within 6" without provoking free attacks',
                    'temporal_assassin' => 'After charge roll, may split through time to attack up to two enemies within charging distance',
                    'infiltrator' => 'Deploy anywhere out of line of sight, at least 8" from closest enemy',
                    'art_of_assassination' => 'May buy one Art of Assassination ability: Hallucinogen Disguise, Thunderbolt of Alamut, Mirage of Time, or Secret Paths',
                    'keywords' => ['ELITE', 'SULTANATE', 'INFILTRATOR', 'TOUGH', 'LEADER'],
                ],
                'lore_text' => 'The most skilled killers of the Old Man of the Mountain, these legendary warriors lead secret missions with abilities that border on the supernatural.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Dervish',
                'slug' => 'dervish',
                'description' => 'Renegade Ismaili warrior monks sworn to poverty and a lethal way of fighting. Their whirling dance of death accompanies Assassins on secret missions.',
                'unit_type' => 'elite',
                'role' => 'infantry',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 55,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 4,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'machine_gun', 'flamethrower'],
                    'armor' => ['standard_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'whirling_dervishes' => 'All Ranged attacks suffer -1 DICE penalty. No -1 DICE penalty for fighting with Off-Hand weapon',
                ],
                'keywords' => ['SULTANATE'],
                'lore_text' => 'These warrior monks have mastered a hypnotic and deadly fighting style, their ritual dance as graceful as it is lethal.',
                'is_active' => true,
                'source_book' => 'Core Rules',
                'variant_restrictions' => ['fidai-of-alamut'],
            ],
            [
                'name' => 'Fāris',
                'slug' => 'faris',
                'description' => 'Noble warriors sworn to protect the House of Wisdom. These elite guardians have taken oaths to defend the scholars in their dangerous journeys.',
                'unit_type' => 'elite',
                'role' => 'infantry',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 55,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 2,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'halberd_gun', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'siege_jezzail', 'musket', 'pistol', 'shotgun', 'sniper_rifle', 'grenades', 'machine_gun', 'flamethrower'],
                    'armor' => ['standard_armour', 'reinforced_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'wind_amulet', 'binoculars', 'holy_relic', 'cloak_of_alamut'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'strong' => 'Ignore HEAVY keyword effects on weapons',
                    'counter_charge' => 'If first ACTION is Charge, add +1 DICE to subsequent Melee Attack ACTIONS this activation',
                ],
                'keywords' => ['ELITE', 'SULTANATE', 'STRONG'],
                'lore_text' => 'Noble warriors who have sworn sacred oaths to protect the scholars of the House of Wisdom, combining martial prowess with unwavering loyalty.',
                'is_active' => true,
                'source_book' => 'Core Rules',
                'variant_restrictions' => ['house-of-wisdom'],
            ],
            [
                'name' => 'Kavass',
                'slug' => 'kavass',
                'description' => 'Sworn guardians of the House of Wisdom, these dedicated bodyguards are trained to fight and die in defense of their scholarly masters.',
                'unit_type' => 'troop',
                'role' => 'infantry',
                'movement' => 6,
                'melee' => -1, // -1 DICE (can be upgraded to +0)
                'ranged' => 0, // 0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 25,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 12,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['trench_knife', 'bayonet', 'trench_club', 'sword', 'axe', 'polearm', 'great_hammer', 'great_maul', 'great_sword', 'great_axe'],
                    'ranged_weapons' => ['jezzail', 'musket', 'pistol', 'shotgun', 'grenades', 'flamethrower'],
                    'armor' => ['standard_armour', 'trench_shield'],
                    'equipment' => ['combat_helmet', 'gas_mask', 'shovel', 'mountaineer_kit', 'medi_kit', 'alchemical_ammunition', 'musicians_instrument', 'wind_amulet'],
                    'upgrades' => ['melee_training_upgrade'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'melee_training' => 'Up to three Kavass can increase Melee characteristic to +0 DICE for +5 ducats each',
                    'no_skirmisher' => 'Cannot buy SKIRMISHER keyword upgrade',
                ],
                'keywords' => ['SULTANATE'],
                'lore_text' => 'These loyal guardians have dedicated their lives to protecting the scholars and secrets of the House of Wisdom, trained in both combat and discretion.',
                'is_active' => true,
                'source_book' => 'Core Rules',
                'variant_restrictions' => ['house-of-wisdom'],
            ],
            [
                'name' => 'Takwin Homunculus',
                'slug' => 'takwin-homunculus',
                'description' => 'Artificial beings created through Jabirean alchemy, each associated with an Alchemist. These creatures can be enhanced with various alchemical formulae.',
                'unit_type' => 'construct',
                'role' => 'support',
                'movement' => 6,
                'melee' => 0, // +0 DICE
                'ranged' => 0, // +0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 40,
                'upkeep_cost' => 4,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 2,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'formulae' => ['wings', 'elemental_resistance', 'massive_size', 'enslaved_mind', 'human_hands', 'inhuman_strength', 'terrifying_appearance', 'additional_arm', 'two_heads', 'hypnotic_eyes', 'hawk_eyes', 'startling_speed', 'seal_of_solomon', 'gargantuan_size', 'regenerative_tissue'],
                ],
                'stat_advancement_options' => [
                    'movement', 'melee', 'ranged', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    're_creation' => 'If killed, can be brought back for 40 ducats with all weapons and abilities',
                    'artificial_body' => 'All injury rolls made with -1 DICE due to lack of vital organs',
                    'alchemist_bound' => 'Must be associated with an Alchemist. If Alchemist dies, cannot be fielded or modified',
                    'alchemical_formulae' => 'Can be enhanced with various formulae for additional abilities and characteristics',
                ],
                'keywords' => ['SULTANATE'],
                'lore_text' => 'These artificial beings represent the pinnacle of Jabirean alchemical arts, capable of being modified and enhanced in countless ways to serve their masters.',
                'is_active' => true,
                'source_book' => 'Core Rules',
                'variant_restrictions' => ['house-of-wisdom'],
            ],
        ];
    }
}
