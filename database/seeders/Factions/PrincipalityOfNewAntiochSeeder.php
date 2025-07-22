<?php

namespace Database\Seeders\Factions;

use Database\Seeders\BaseFactionSeeder;

/**
 * Principality of New Antioch Faction Seeder
 *
 * Seeds comprehensive data for The Principality of New Antioch faction - the fortress-city
 * that stands as the bulwark against Hell and the focal point of the Church and the Faithful.
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
            'description' => 'The fortress-city that stands as the bulwark against Hell and the focal point of the Church and the Faithful at the very edge of the shadow cast by the Gate of Hell.',
            'lore' => 'For three hundred years the Principality of New Antioch has stood defiantly as the Home of All Our Hopes, the bulwark against Heretic forces and the first line of defence against the devil\'s might. More than anything else, it is the volunteers who come to serve under the Banner of Christ that ensure the continuous existence of the Principality. The standing army of the Principality is the greatest single fighting force the Faithful can muster.',
            'primary_color' => '#8B0000', // Dark Red (representing the blood of martyrs)
            'secondary_color' => '#FFD700', // Gold (representing divine glory)
            'icon' => 'shield',
            'is_active' => true,
            'sort_order' => 1, // Primary faction, should be first
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
                'name' => 'Papal States Intervention Force',
                'slug' => 'papal-states-intervention-force',
                'description' => 'The Papal states who operate under the command of the Supreme Pontiff of Rome are dispatched to perform specific duties such as hunting down dangerous Heretic leaders or recovering artefacts of great spiritual importance.',
                'special_rules' => 'Specialist Force: Campaign 500 ducats + 11 Glory Points, One-off 700 ducats + 15 Glory Points. Swiss Guard upgrades (+5 ducats, immune to FEAR). Supreme Blessing (crucifix allows continued actions after failed RISKY ACTION). Vatican\'s representative (must include Trench Cleric, Lieutenant optional). Lector prayer: "Arise and be Healed!" Far from home (no Trench Moles).',
                'icon' => 'cross',
                'starting_resources' => [
                    'campaign_ducats' => 500,
                    'campaign_glory_points' => 11,
                    'oneoff_ducats' => 700,
                    'oneoff_glory_points' => 15,
                ],
                'unit_restrictions' => [
                    'required_trench_cleric' => true,
                    'optional_lieutenant' => true,
                    'max_swiss_guard_upgrades' => 4,
                    'no_trench_moles' => true,
                ],
                'equipment_restrictions' => [
                    'supreme_blessing_cost' => 3, // Glory Points to replace if lost
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Eire Rangers',
                'slug' => 'eire-rangers',
                'description' => 'Masters of skirmish fighting, hit-and-run tactics and ambushes from the warriors of Eire. The Poet-King Tadhg O\'Connor dispatches his famed Rangers to aid New Antioch instead of paying the yearly tithe.',
                'special_rules' => 'Fianna (Shocktroopers +10 ducats gain SKIRMISHER, INFILTRATOR). Carnyx (special musical instrument for ELITE, causes FEAR). Hit-and-run tactics (-1 DICE penalty to enemy free attacks on Retreat). Berserker (Lieutenant or Fianna +15 ducats, immune to FEAR, disregards BLOOD MARKERS, no armour except Trench Shield). Strong in faith (up to 2 Trench Clerics). Loose organisation (only 1 FIRETEAM, Lieutenant loses "On my command!" gains SKIRMISHER). Light Infantry (only 1 MHI, no HEAVY weapons/armour except Combat Engineers). Followers of St. Patrick (Campaign patron automatically St. Patrick).',
                'icon' => 'shield-check',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'max_fireteams' => 1,
                    'max_trench_clerics' => 2,
                    'max_mechanized_heavy_infantry' => 1,
                    'fianna_upgrade_cost' => 10,
                    'berserker_upgrade_cost' => 15,
                    'no_heavy_weapons_except_engineers' => true,
                    'no_heavy_machine_armour_except_mhi_lieutenant' => true,
                ],
                'equipment_restrictions' => [
                    'carnyx_available' => true,
                    'light_infantry_restrictions' => true,
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Stoßtruppen of the Free State of Prussia',
                'slug' => 'stosstrupppen-prussia',
                'description' => 'Elite units selected and trained specifically to perform lightning assaults, master the firearms of close assault, and operate in perfectly synchronised Fireteams.',
                'special_rules' => 'Expert Fireteams (up to 3 FIRETEAMS). Masters of the Grenade (+4" range to GRENADE weapons). Forward Positions (up to 2 Shocktroopers gain INFILTRATOR +10 ducats). Rapid Assault (Shocktroopers/Lieutenants +5 ducats for +1 DICE to Dash ACTIONS). Specialised Equipment (LIMIT:4 Submachine guns, Automatic Shotguns/Pistols not ELITE-only, no Grenade Launchers, max 1 Machine Gun). Troop Selection (2-8 Shocktroopers required, max 1 MHI, max 1 Sniper Priest, no Trench Moles). Lightly-armoured (no Reinforced/Machine Armour except MHI/Lieutenant). Light Melee (Prussian Shocktroopers lose Assault Drill).',
                'icon' => 'zap',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'max_fireteams' => 3,
                    'min_shocktroopers' => 2,
                    'max_shocktroopers' => 8,
                    'max_mechanized_heavy_infantry' => 1,
                    'max_sniper_priests' => 1,
                    'no_trench_moles' => true,
                    'infiltrator_upgrade_cost' => 10,
                    'rapid_assault_upgrade_cost' => 5,
                    'no_reinforced_machine_armour_except_mhi_lieutenant' => true,
                ],
                'equipment_restrictions' => [
                    'submachine_gun_limit' => 4,
                    'automatic_shotgun_not_elite_only' => true,
                    'automatic_pistol_not_elite_only' => true,
                    'no_grenade_launchers' => true,
                    'max_machine_guns' => 1,
                    'tank_splitter_sword_available' => true,
                    'tank_splitter_sword_limit' => 3,
                    'tank_splitter_sword_cost' => 15,
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Kingdom of Alba Assault Detachment',
                'slug' => 'kingdom-alba-assault',
                'description' => 'Hailing from the Scottish Highlands where the Church is strong, these warriors favour close quarters combat and fierce charges over defence and long-range attacks.',
                'special_rules' => 'Rampant Charge (ignore penalty for Defended Obstacles). Melee-focused (MHI +1 DICE melee instead of ranged). Highland Machine Armour (ignore charging penalty from machine armour). Highland Strength (Lieutenant has STRONG keyword). Strained Supply (LIMIT:1 for Grenade Launchers, Submachine Guns, Machine Guns, Automatic Shotguns, Sniper Rifles). Bagpipes (special musical instrument, friendly models within 4" immune to FEAR). Brave (+1 DICE to all Morale Tests). Claymore Smiths (Great Swords cost 7 ducats instead of 12). Lightly-armoured (no Reinforced/Machine Armour except MHI/Lieutenant).',
                'icon' => 'sword',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'lieutenant_has_strong' => true,
                    'mechanized_heavy_infantry_melee_focused' => true,
                    'no_reinforced_machine_armour_except_mhi_lieutenant' => true,
                ],
                'equipment_restrictions' => [
                    'grenade_launcher_limit' => 1,
                    'submachine_gun_limit' => 1,
                    'machine_gun_limit' => 1,
                    'automatic_shotgun_limit' => 1,
                    'sniper_rifle_limit' => 1,
                    'bagpipes_available' => true,
                    'great_sword_reduced_cost' => 7,
                    'lochaber_axe_available' => true,
                    'lochaber_axe_cost' => 15,
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Expeditionary Forces of Abyssinia',
                'slug' => 'expeditionary-forces-abyssinia',
                'description' => 'Masters of mobile warfare claiming direct lineage from the legendary queen of Sheba and King Solomon. The Emperors of Abyssinia are staunch members of the Faithful alliance.',
                'special_rules' => 'Chewa (Shocktroopers/ELITE +5 ducats gain +1 DICE vs enemies in melee with friendly, +2 DICE if enemy in melee with 2+ friendlies). Faith of Ethiopia (no Sniper Priests). Flanking Forces (no Trench Moles, up to 4 Yeomen become Vanguards +5 ducats, deploy on any table edge 8"+ from enemies after INFILTRATORS). Short-Range Marksmanship (Yeomen/Vanguard/Lieutenant +1 DICE ranged at short range, not GRENADES/HEAVY). Abyssinian Healers (up to 2 Combat Medics). Holy Warriors (up to 2 Holy Warriors using Trench Cleric profile). Chieftain Panoply (MHI cannot upgrade to Machine Armour). Weapons of Mobile Warfare (max 3 HEAVY ranged weapons, not including satchel charges).',
                'icon' => 'crown',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'no_sniper_priests' => true,
                    'no_trench_moles' => true,
                    'max_vanguard_upgrades' => 4,
                    'vanguard_upgrade_cost' => 5,
                    'chewa_upgrade_cost' => 5,
                    'max_combat_medics' => 2,
                    'max_holy_warriors' => 2,
                    'mechanized_heavy_infantry_no_machine_armour' => true,
                    'max_heavy_ranged_weapons' => 3,
                ],
                'equipment_restrictions' => [
                    'shotel_available' => true,
                    'shotel_cost' => 5,
                    'holy_water_lalibela_available' => true,
                    'holy_water_lalibela_cost' => 3,
                    'holy_water_lalibela_limit' => 4,
                    'anfarro_available' => true,
                    'anfarro_cost' => 10,
                    'anfarro_limit' => 6,
                    'tabot_available' => true,
                    'tabot_cost' => 4, // Glory Points
                ],
                'is_active' => true,
                'sort_order' => 5,
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
            // ELITE UNITS
            [
                'name' => 'Lieutenant',
                'slug' => 'lieutenant',
                'description' => 'Leaders of small squads or platoons, displaying unwavering resolve in preserving the unity and morale of their troops. They might be the favoured son or daughter of a noble family or gained their rank through exceptional strategic acumen and audacious bravery.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 2, // +2 Dice
                'ranged' => 2, // +2 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 70,
                'upkeep_cost' => 7,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury',
                    'armour' => 'Any armour from New Antioch Armoury',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to the rules for TOUGH creatures',
                    'on_my_command' => 'Once per Turn, as an ACTION the Lieutenant can force the opponent to activate one of their models that the Lieutenant can select from amongst the models they can see. This ends the Activation of the Lieutenant.',
                ],
                'lore_text' => 'Your warband must include a Lieutenant when it is created. Lieutenants are leaders of small squads or platoons, displaying unwavering resolve in preserving the unity and morale of their troops.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Trench Cleric',
                'slug' => 'trench-cleric',
                'description' => 'A holy warrior who looks after the souls of the soldiers in the company, the cleric chants inspiring battle prayers and can perform various miracles such as healing or even smiting the enemy.',
                'unit_type' => 'elite',
                'role' => 'support',
                'movement' => 6,
                'melee' => 1, // +1 Dice
                'ranged' => 1, // +1 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 60,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury',
                    'armour' => 'Any armour from New Antioch Armoury',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'god_is_with_us' => 'Select one friendly model within 6" of the Priest (including the Priest) and take a RISKY ACTION. If successful, the model immediately gains a BLESSING MARKER.',
                    'onwards_christian_soldiers' => 'All friendly models that are within 8" of the Trench Cleric at the start of their Activation are not affected by FEAR.',
                ],
                'lore_text' => 'A holy warrior who looks after the souls of the soldiers in the company, the cleric chants inspiring battle prayers and can perform various miracles such as healing or even smiting the enemy.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Sniper Priest',
                'slug' => 'sniper-priest',
                'description' => 'These devotees of the Church blind themselves ritually as a devotion to God and use only their faith to strike the enemies of the Church. During the Siege of St. Lux stories were told of a sniper priest killing a target three miles away.',
                'unit_type' => 'elite',
                'role' => 'specialist',
                'movement' => 6,
                'melee' => -1, // -1 Dice
                'ranged' => 2, // +2 Dice
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
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury',
                    'armour' => 'Any armour from New Antioch Armoury',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'aim' => 'A Sniper Priest may take a RISKY ACTION to aim. If successful then the Priest may add +2 DICE to any Ranged attack rolls during this same Activation.',
                    'absolute_faith' => 'Sniper Priests do not use their eyesight to aim at their enemies. The opponent cannot apply any BLOOD MARKERS when they use a Ranged weapon. They still suffer penalties for Range and Cover as standard.',
                ],
                'lore_text' => 'These devotees of the Church blind themselves ritually as a devotion to God and use only their faith to strike the enemies of the Church. During the Siege of St. Lux stories were told of a sniper priest killing a target three miles away.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // TROOPER UNITS
            [
                'name' => 'Yeoman',
                'slug' => 'yeoman',
                'description' => 'A basic trooper of New Antioch. Brave men and women who have received standard training and sworn an oath to the Duke of New Antioch. What they lack in combat skills compared to more elite troops they more than make up with their numbers and wide selection of weapons available to them.',
                'unit_type' => 'trooper',
                'role' => 'line_infantry',
                'movement' => 6,
                'melee' => 0, // 0 Dice
                'ranged' => 0, // 0 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 35, // 30 + 5 for mandatory Bolt Action Rifle
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 99, // No limit specified
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'bolt_action_rifle',
                ],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury (can swap rifle for another ranged weapon)',
                    'armour' => 'Any armour from New Antioch Armoury',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                    'upgrades' => 'Can be upgraded to Trench Mole (+10 ducats, gains INFILTRATOR keyword)',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'trench_mole_upgrade' => 'At the cost of +10 ducats per model, up to two yeomen can be upgraded to Trench Moles (up to three in warbands of over 1000 ducats value). They gain the Keyword INFILTRATOR.',
                ],
                'lore_text' => 'A basic trooper of New Antioch. Brave men and women who have received standard training and sworn an oath to the Duke of New Antioch. What they lack in combat skills compared to more elite troops they more than make up with their numbers and wide selection of weapons available to them.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Shocktrooper',
                'slug' => 'shocktrooper',
                'description' => 'Assault Troops that specialise in attacking enemy defensive positions. They are masters of rapid assault and melee combat. Experts at combined arms and Fireteam tactics.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 1, // +1 Dice
                'ranged' => 0, // +0 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 45,
                'upkeep_cost' => 4,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 5,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury',
                    'armour' => 'Any armour from New Antioch Armoury',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'shock_charge' => 'When a Shocktrooper charges, roll 2D6 instead of 1D6 and then add the highest of the two dice to their charge move.',
                    'assault_drill' => 'Shocktroopers ignore the effects of Keyword HEAVY on Melee weapons. The Shocktrooper can still only carry a single HEAVY item, unless they are STRONG.',
                ],
                'lore_text' => 'Assault Troops that specialise in attacking enemy defensive positions. They are masters of rapid assault and melee combat. Experts at combined arms and Fireteam tactics.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Combat Engineer',
                'slug' => 'combat-engineer',
                'description' => 'The combat engineers specialise in destroying bunkers, discovering minefields and building battlefield emplacements. Casualties are extremely high in the combat engineer units, but they consider it an honour to fight and die for New Antioch and the Church.',
                'unit_type' => 'trooper',
                'role' => 'specialist',
                'movement' => 6,
                'melee' => 0, // +0 Dice
                'ranged' => 1, // +1 Dice
                'strength' => 0,
                'fortitude' => -2, // -2 Armour modifier
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 80,
                'upkeep_cost' => 8,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 2,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'shovel',
                    'engineer_body_armour',
                ],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                    'note' => 'Shovel and Engineer Body Armour can never be removed',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'battlefield_demolition' => 'The Engineer ignores HEAVY rules for Satchel Charges.',
                    'fortify' => 'During their Activation, an Engineer can take a RISKY ACTION with +1 DICE. If successful, the engineer is considered to be in Cover until the model moves. This ACTION cannot be used if the model is in Melee combat.',
                    'de_mine' => 'As a RISKY ACTION the Engineer can disable any mine or trapped terrain they move in contact with. If they fail, the mine blows up as described in applicable rules.',
                    'engineer_body_armour' => 'Grants a -2 modifier to injury rolls made against the Combat Engineer. All weapons with keyword SHRAPNEL suffer -1 DICE on all injury rolls against the Combat Engineer and SHRAPNEL attacks do not cause extra BLOOD MARKERS on a model wearing this suit. The effects relating to SHRAPNEL work even against attacks that ignore armour.',
                ],
                'lore_text' => 'The combat engineers specialise in destroying bunkers, discovering minefields and building battlefield emplacements. Casualties are extremely high in the combat engineer units, but they consider it an honour to fight and die for New Antioch and the Church.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Mechanized Heavy Infantry',
                'slug' => 'mechanized-heavy-infantry',
                'description' => 'Well-armoured, large soldiers who wield the heavy weaponry of the company. They are selected from amongst the best and given heavy chemical enhancements.',
                'unit_type' => 'trooper',
                'role' => 'heavy_support',
                'movement' => 6,
                'melee' => 0, // +0 Dice
                'ranged' => 1, // +1 Dice
                'strength' => 0,
                'fortitude' => -2, // -2 Armour modifier (Light Machine Armour)
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 85,
                'upkeep_cost' => 8,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'light_machine_armour', // Counts as Reinforced Armour
                ],
                'equipment_options' => [
                    'weapons' => 'Any weapon from New Antioch Armoury',
                    'armour' => 'Can upgrade to Machine Armour for +10 Ducats (ignoring LIMIT: 1 restriction)',
                    'equipment' => 'Any equipment from New Antioch Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'strong' => 'The Mechanized Heavy Infantry ignores the effect of the Keyword HEAVY on any weapon they wield.',
                ],
                'lore_text' => 'Well-armoured, large soldiers who wield the heavy weaponry of the company. They are selected from amongst the best and given heavy chemical enhancements.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Combat Medic',
                'slug' => 'combat-medic',
                'description' => 'The Sisters of St. Cosmas are a highly trained elite medical corps, specialising in battlefield first aid and surgeries on the front lines of the Great War. Armed with a combat surgical knife that doubles as a Misericordia, they are as equally adept at saving lives as taking them.',
                'unit_type' => 'trooper',
                'role' => 'support',
                'movement' => 6,
                'melee' => 0, // +0 Dice
                'ranged' => 0, // +0 Dice
                'strength' => 0,
                'fortitude' => -1, // -1 Armour modifier (standard armour)
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 65,
                'upkeep_cost' => 6,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'misericordia',
                    'medi_kit',
                    'gas_mask',
                    'standard_armour',
                ],
                'equipment_options' => [
                    'note' => 'You cannot modify the equipment, armour and weapons of the medic in any way.',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'finish_the_fallen' => 'Unless the target has the Keyword DEMONIC or BLACK GRAIL, add +1 BONUS DICE to any injury rolls the medic makes in melee against opponents who are Down.',
                    'expert_medic' => 'Medic adds +1 BONUS DICE whenever they use their Medi-Kit to aid friendly models.',
                    'convent_conditioning' => 'The medic is immune to FEAR.',
                ],
                'lore_text' => 'The Sisters of St. Cosmas are a highly trained elite medical corps, specialising in battlefield first aid and surgeries on the front lines of the Great War. Armed with a combat surgical knife that doubles as a Misericordia, they are as equally adept at saving lives as taking them.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
