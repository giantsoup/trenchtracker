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
                'name' => 'Heretic Naval Raiding Party',
                'slug' => 'heretic-naval-raiding-party',
                'description' => 'The Heretic Fleet operates as a semi-autonomous entity under the command of its High Captain and other admirals. The Heretics have their own marine infantry that often operates in small bands, striking deep behind enemy lines and executing smash and grab missions.',
                'special_rules' => 'Fast as Lightning: All Models have (+1 DICE) when taking their Dash ACTIONS. Close Assault Weapons: The warband can buy Submachine Guns for 25 ducats per weapon. Light Troops: The force may only include 0-1 Anointed and 0-1 Artillery Witch. Let Sleeping Dogs Lie: The warband may not include a War Wolf. Unseen Advance: Up to three models without the ELITE Keyword can be upgraded into INFILTRATORS at the cost of 10 ducats per Model.',
                'icon' => 'anchor',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'max_anointed' => 1,
                    'max_artillery_witch' => 1,
                    'no_war_wolf' => true,
                    'max_infiltrator_upgrades' => 3,
                ],
                'equipment_restrictions' => [
                    'submachine_gun_cost' => 25,
                    'infiltrator_upgrade_cost' => 10,
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Trench Ghosts',
                'slug' => 'trench-ghosts',
                'description' => 'Sometimes when Heretic troopers die upon a hallowed ground or in presence of an uncorrupted holy relic, they become trapped between planes of existence. Claimed by neither Heaven nor Hell, the Trench Ghosts become Undead – doomed to fight a war without an end.',
                'special_rules' => 'Horror: All models in the Warband cause FEAR. Semi-corporeal: Any Ranged attacks against all models roll injuries with (-1 DICE). Spectral: All models ignore movement penalties from Difficult Terrain. Undead: All models do not suffer additional BLOOD MARKERS from GAS attacks. Enemies of All: Cannot use Mercenaries. Lost Souls: No ARTIFICIAL models, no Hellbound Soul Contract or Infernal Brand Mark. Slow: Half Dash distance (3"), (-1 DICE) to attacks against Retreating models. Sarcophagus Mine: Up to 2 Troopers can become mines (+30 ducats each). Barbed Wire Banshee: Can replace Chorister with Banshee (Death Wail ability). Tank Palanquin: Heretic Priest can ride Tank Palanquin (+60 ducats, STRONG keyword).',
                'icon' => 'skull',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'no_mercenaries' => true,
                    'no_artificial_models' => true,
                    'max_sarcophagus_mines' => 2,
                    'can_replace_chorister_with_banshee' => true,
                ],
                'equipment_restrictions' => [
                    'no_hellbound_soul_contract' => true,
                    'no_infernal_brand_mark' => true,
                    'sarcophagus_mine_cost' => 30,
                    'tank_palanquin_cost' => 60,
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Knights of Avarice',
                'slug' => 'knights-of-avarice',
                'description' => 'The warbands who follow the Prince of Greed call themselves the Knights of Avarice. Such heretics display their wealth extravagantly and prefer to carry the most expensive and hard-to-acquire weapons, armour and equipment.',
                'special_rules' => 'Worship Mammon: Patron always Mammon. Price of Greed ability instead of Puppet Master. Mammon\'s Chosen: No models under 80 ducats (including equipment). Corrupt Merchants: Select one item each from New Antioch and Iron Sultanate Armouries. Preserve the Loot: No FIRE or SHRAPNEL weapons. Artillery Witches use Gas Bombs. Infernal Rivalry: No Death Commandos. Goetic Warlocks: May include one for 110 ducats (mercenary rules). Debtors to Mammon: Wretched not bound by Mammon\'s Chosen rule.',
                'icon' => 'coins',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'min_model_cost' => 80,
                    'no_death_commandos' => true,
                    'max_goetic_warlocks' => 1,
                    'wretched_exempt_from_min_cost' => true,
                ],
                'equipment_restrictions' => [
                    'no_fire_weapons' => true,
                    'no_shrapnel_weapons' => true,
                    'artillery_witch_gas_bombs' => true,
                    'goetic_warlock_cost' => 110,
                    'foreign_armoury_access' => ['new_antioch', 'iron_sultanate'],
                ],
                'is_active' => true,
                'sort_order' => 3,
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
            // HERETIC ELITES - God's Chosen
            [
                'name' => 'Heretic Priest',
                'slug' => 'heretic-priest',
                'description' => 'The Leader of a Heretic warband. These fallen priests perform all kinds of unholy magics, summoning petrifying demons and creatures using their Goetic spells.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 2, // +2 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 80,
                'upkeep_cost' => 8,
                'max_wounds' => 1,
                'min_warband_size' => 1,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => true,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => ['any_heretic_legion_weapon'],
                    'armor' => ['any_heretic_legion_armor'],
                    'equipment' => ['any_heretic_legion_equipment'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'puppet_master' => 'Select a target model within 12". As a RISKY ACTION move the model D6" in any direction, including forcing combat or retreat.',
                    'tough' => 'Subject to TOUGH creature rules due to demonic vitality.',
                ],
                'lore_text' => 'Often pledged to a Demon Lord in Hell, such as Pazuzu or Guison, the Profane Gospels they recite terrify church forces, causing ears to bleed and eyeballs to burst in their sockets.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Heretic Death Commando',
                'slug' => 'heretic-death-commando',
                'description' => 'Silent Killers equipped with stealth generators that hide them from the eyes of God. These terrifying infiltrators have been known to kill entire enemy squads alone.',
                'unit_type' => 'elite',
                'role' => 'infiltrator',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 90,
                'upkeep_cost' => 9,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => true,
                'starting_equipment' => [],
                'equipment_options' => [
                    'ranged_weapons' => ['silenced_pistol', 'tormentor_chain', 'gas_grenades'],
                    'melee_weapons' => ['any_heretic_legion_melee'],
                    'armor' => ['any_heretic_legion_armor'],
                    'equipment' => ['any_heretic_legion_equipment'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'infiltrator' => 'Can be placed anywhere out of LOS of enemies, at least 8" away. Deploy after all non-infiltrator models.',
                    'stealth_generator' => 'Ranged attacks against Death Commando suffer (-1 DICE) to all attack rolls.',
                    'hide' => 'As RISKY ACTION with (+1 DICE) can hide if touching scenery. Enemies cannot target with ranged attacks or charges.',
                ],
                'lore_text' => 'These terrifying infiltrators move unseen through enemy lines, striking from the shadows with deadly precision.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Heretic Chorister',
                'slug' => 'heretic-chorister',
                'description' => 'Suicide is a Mortal Sin, and sacrificing yourself to the glory of Hell is a yet greater affront to God. Their severed heads sing their agonising hymns, weakening enemies.',
                'unit_type' => 'elite',
                'role' => 'support',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => -2, // -2 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 65,
                'upkeep_cost' => 7,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => true,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => ['any_heretic_legion_weapon'],
                    'armor' => ['any_heretic_legion_armor'],
                    'equipment' => ['any_heretic_legion_equipment'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'unholy_hymns' => 'All enemy models within 8" suffer additional (-1 DICE) for all ACTIONS they attempt.',
                    'unholy_horror' => 'The Chorister causes FEAR.',
                ],
                'lore_text' => 'Some Heretics born with a gift of sonorous voice pursue the dark path of becoming a Chorister, their minds filled with visions from the Pits of Hell.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // LEGIONNAIRES OF HELL
            [
                'name' => 'Heretic Trooper',
                'slug' => 'heretic-trooper',
                'description' => 'These soldiers make up the bulk of the Heretic forces. They have witnessed the Gate of Hell and survived, damning them for all eternity.',
                'unit_type' => 'trooper',
                'role' => 'line_infantry',
                'movement' => 6,
                'melee' => 0,
                'ranged' => 0,
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 30,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 20,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => ['any_heretic_legion_weapon'],
                    'armor' => ['any_heretic_legion_armor'],
                    'equipment' => ['any_heretic_legion_equipment'],
                    'upgrades' => ['legionnaire_upgrade_10_ducats'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'legionnaire_upgrade' => 'Can upgrade up to half (rounding down) to Heretic Legionnaires for +10 ducats each. Choose +1 DICE to either Ranged or Melee.',
                ],
                'lore_text' => 'The backbone of Heretic forces, these damned souls have gazed upon Hell\'s gates and lived to tell the tale.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Anointed Heavy Infantry',
                'slug' => 'anointed-heavy-infantry',
                'description' => 'Heavily armed and armoured assault troops. Their skin is burned and blistering from their ordained pilgrimages to Hell and back.',
                'unit_type' => 'heavy_infantry',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => -2, // Armor value
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 95,
                'upkeep_cost' => 10,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 5,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'reinforced_armor',
                    'infernal_brand_mark',
                ],
                'equipment_options' => [
                    'weapons' => ['any_heretic_legion_weapon'],
                    'armor' => ['trench_shield'],
                    'equipment' => ['any_heretic_legion_equipment'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'strong' => 'Ignores the effect of the HEAVY keyword on any weapon they wield.',
                ],
                'lore_text' => 'Having tread the accursed path to the shores of the Lake of Eternal Flame, the Anointed emerge forever scarred by abyssal fires.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // BEASTS AND ABOMINATIONS
            [
                'name' => 'War Wolf Assault Beast',
                'slug' => 'war-wolf-assault-beast',
                'description' => 'This abomination charges through miles of barbed wire to clear a path for the heretic infantry; its uniquely formed head designed to cut clean through it.',
                'unit_type' => 'beast',
                'role' => 'assault',
                'movement' => 8,
                'melee' => 2, // +2 DICE
                'ranged' => 0, // N/A
                'strength' => 0,
                'fortitude' => -3, // Armor value
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 140,
                'upkeep_cost' => 14,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => true,
                'starting_equipment' => [
                    'tartarus_armor',
                    'chainsaw_mouth',
                    'shredding_claws',
                ],
                'equipment_options' => [],
                'stat_advancement_options' => [
                    'melee', 'strength', 'fortitude', 'leadership',
                ],
                'special_rules' => [
                    'tough' => 'Subject to TOUGH creature rules due to unnatural vitality.',
                    'loping_dash' => 'May take Dash ACTION with (+2 DICE). Ignores movement penalties from Difficult Terrain.',
                    'terrifying' => 'Causes FEAR as a blasphemous creation of Hell.',
                    'chainmaw' => 'Chainsaw Mouth: RISKY weapon, (+1 DICE) to hit, ignores armor, (+1 DICE) to injure.',
                    'shredding_claws' => 'Two-handed RISKY CUMBERSOME weapon, (+1 DICE) to injure, treated as off-hand alongside Chainmaw.',
                ],
                'lore_text' => 'War Wolves wear unique armour forged in the factories of hell, as seen by the maker\'s marks stamped upon it.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Artillery Witch',
                'slug' => 'artillery-witch',
                'description' => 'Artillery Witches stalk the battlefields, hurling ordnance assembled in the death factories of Hell\'s Third Circle. They are completely mute and no one has ever seen their faces.',
                'unit_type' => 'specialist',
                'role' => 'artillery',
                'movement' => 6,
                'melee' => -1, // -1 DICE
                'ranged' => 0,
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 90,
                'upkeep_cost' => 9,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1, // 0-2 in warbands over 1000 ducats
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'infernal_bombs',
                ],
                'equipment_options' => [
                    'melee_weapons' => ['any_heretic_legion_melee'],
                    'armor' => ['any_heretic_legion_armor'],
                    'equipment' => ['any_heretic_legion_equipment'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'infernal_bomb' => 'One-handed ranged weapon with BLAST 3". Target point within 36". Failed rolls scatter. Direct hits roll 3D6 injury. SHRAPNEL keyword. Activation ends after use.',
                    'artificial_life' => 'Not affected by FEAR. GAS attacks suffer (-1 DICE) to injure and no additional BLOOD MARKERS.',
                    'levitate' => 'Can Climb without taking ACTION. Does not roll injury when falling.',
                ],
                'lore_text' => 'Guided by the teachings of Tartarus\' smiths, these mute figures wield the forbidden secrets of infernal metallurgy.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // AUXILIARIES
            [
                'name' => 'Wretched',
                'slug' => 'wretched',
                'description' => 'Many unfortunates fall into the hands of the Heretic warbands. The law of Hell is clear: those who rebel against God can gain their freedom if they perform sufficiently great deeds.',
                'unit_type' => 'auxiliary',
                'role' => 'cannon_fodder',
                'movement' => 6,
                'melee' => -1, // -1 DICE
                'ranged' => -1, // -1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 25,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 20, // Must be outnumbered by HERETIC models
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => ['any_heretic_legion_melee_under_10_ducats'],
                    'armor' => ['any_heretic_legion_armor_under_10_ducats'],
                    'equipment' => ['any_heretic_legion_equipment_under_10_ducats'],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'law_of_hell' => 'If takes any ELITE model Out of Action or performs Glorious Deed, gains freedom and is removed permanently.',
                    'dark_blessing' => 'If taken Out of Action, one HERETIC ELITE model gains one BLESSING MARKER.',
                    'chattel' => 'Can be sold at any time for full ducat value between battles.',
                    'equipment_limit' => 'No equipment can cost more than 10 ducats each. Must be equipped with at least one weapon.',
                ],
                'lore_text' => 'Driven swarms of the Wretched are pushed ahead to blunt and slow down enemy assaults, seeking redemption through service.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
