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
                'name' => 'Procession of the Sacred Affliction',
                'slug' => 'procession-sacred-affliction',
                'description' => 'Trench Pilgrims known for their zeal in close quarter combat, their armour decorated with icons and shields adorned with the depictions of the Saints. They spurn the use of Iron Capirotes, believing firmly that faith alone is enough to withstand the horrors of Hell.',
                'special_rules' => 'Face thy Fears: No Iron Capirotes allowed. Reliquary Armoury: All models can buy Holy Icon Shields for 20 ducats, ELITE models may acquire Holy Icon Armour. Punishing Millstones: +1 DICE to injury rolls in melee against Down models. Melee-focused: No Machine Guns, max 1 Punt Gun. Zealot Strength: Up to 3 Trench Pilgrims may purchase upgrade. Hammer and Anvil: Anti-tank Hammers not limited to ELITE. Wrath of God: One model can be gripped by vengeful fury (+15 ducats, immune to FEAR, disregards BLOOD MARKERS, no armour except shields, no ranged weapons).',
                'icon' => 'shield',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'no_iron_capirotes' => true,
                    'max_machine_guns' => 0,
                    'max_punt_guns' => 1,
                    'max_zealot_strength_pilgrims' => 3,
                    'max_wrath_of_god' => 1,
                ],
                'equipment_restrictions' => [
                    'holy_icon_shield_cost' => 20, // ducats for all models
                    'holy_icon_armour_available' => true, // for ELITE only
                    'holy_icon_armour_cost' => 30,
                    'anti_tank_hammer_not_elite_only' => true,
                    'wrath_of_god_upgrade_cost' => 15,
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cavalcade of the Tenth Plague',
                'slug' => 'cavalcade-tenth-plague',
                'description' => 'This Trench Pilgrim Procession traditionally sacrifices lambs before battle, anointing themselves in its blood to ward off the wrath of God. Firm believers in traditional reading of the Holy Texts, they reject the new doctrines of the Meta-Christ.',
                'special_rules' => 'Blood Sacrifice: Any model can purchase Sacrificial Lamb (5 ducats, CONSUMABLE). Heaven Awaits: Dead Pilgrims cannot be resurrected as Martyr-Penitents. The Unclean: Max 2 Ecclesiastic Prisoners. Day of his Wrath: War Prophet cannot use Laying on Hands but can call Wrath of God (RISKY ACTION, injury roll against enemy within 3", ignores armour). Stolen Communicants: Cost 3 Glory Points instead of ducats. Favour of the Lord: At start of each turn, give any one model a BLESSING MARKER.',
                'icon' => 'droplets',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'max_ecclesiastic_prisoners' => 2,
                    'no_martyr_penitent_resurrection' => true,
                    'communicant_cost_glory_points' => 3,
                ],
                'equipment_restrictions' => [
                    'sacrificial_lamb_available' => true,
                    'sacrificial_lamb_cost' => 5,
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'War Pilgrimage of Saint Methodius',
                'slug' => 'war-pilgrimage-saint-methodius',
                'description' => 'A well-equipped and disciplined War Pilgrimage founded by brother Akakios on Mount Athos. No other Pilgrim Procession can match the methodical and technical approach of the soldiers of the Order.',
                'special_rules' => 'Anchorite Cloister: May buy up to 2 Anchorite Shrines. Anchorite Armoury: May alter Anchorite weaponry, +0 DICE to Ranged. Mortal Sin: No Martyrdom Devices, no Broken on Wheel. Communicant Heresy: Cannot include Communicants. Treasure in Heaven: No Martyr-Penitent resurrection. Chaste Order: All Stigmatic Nuns must wear Standard Armour, max 3 Nuns. Gunsmith Monks: Machine Guns 50 ducats (LIMIT:2), Automatic Rifle 40 ducats (LIMIT:1), Submachine Gun 30 ducats (LIMIT:1). Followers of St. Methodius: Patron always Learned Saint.',
                'icon' => 'cog',
                'starting_resources' => [
                    'campaign_ducats' => 700,
                    'oneoff_ducats' => 900,
                    'oneoff_glory_points' => 8,
                ],
                'unit_restrictions' => [
                    'max_shrine_anchorites' => 2,
                    'no_martyrdom_devices' => true,
                    'no_broken_on_wheel' => true,
                    'no_communicants' => true,
                    'no_martyr_penitent_resurrection' => true,
                    'max_stigmatic_nuns' => 3,
                    'stigmatic_nuns_require_standard_armour' => true,
                ],
                'equipment_restrictions' => [
                    'machine_gun_cost' => 50,
                    'machine_gun_limit' => 2,
                    'automatic_rifle_cost' => 40,
                    'automatic_rifle_limit' => 1,
                    'submachine_gun_cost' => 30,
                    'submachine_gun_limit' => 1,
                    'anchorite_weapon_customization' => true,
                ],
                'is_active' => true,
                'sort_order' => 3,
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
            // ELITE UNITS - God's Chosen
            [
                'name' => 'War Prophet',
                'slug' => 'war-prophet',
                'description' => 'A charismatic leader and powerful fighter of the Pilgrim group. They are driven by visions of Armageddon, and their preaching and prophecies drive the pilgrimage from one battlefield to the next.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 2, // +2 Dice
                'ranged' => 2, // +2 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 80,
                'upkeep_cost' => 8,
                'max_wounds' => 1,
                'min_warband_size' => 1, // Required
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Trench Pilgrims Armoury',
                    'armour' => 'Any armour from Trench Pilgrims Armoury',
                    'equipment' => 'Any equipment from Trench Pilgrims Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'loudspeakers' => 'RISKY ACTION with +2 DICE: if successful, all friendly models within 8" can move 3" towards any enemy they can see, entering combat as if they charged',
                    'memento_mori' => 'Once per battle, when taken Out of Action, ignore the result as if nothing happened',
                    'laying_on_hands' => 'With successful ACTION, remove D3 BLOOD MARKERS from any friendly model within 6"',
                ],
                'lore_text' => 'Your warband must include a War Prophet when it is created. Charismatic leaders driven by visions of Armageddon, seeking martyrdom in combat.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Castigator',
                'slug' => 'castigator',
                'description' => 'Tasked with instilling the Fear of God in the troops, this orthodoxy officer keeps the soldiers on the path of righteousness and punishes those who transgress.',
                'unit_type' => 'elite',
                'role' => 'support',
                'movement' => 6,
                'melee' => 1, // +1 Dice
                'ranged' => 1, // +1 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 50,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Trench Pilgrims Armoury',
                    'armour' => 'Any armour from Trench Pilgrims Armoury',
                    'equipment' => 'Any equipment from Trench Pilgrims Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'enforced_orthodoxy' => 'RISKY ACTION with +1 DICE: if successful, all friendly Down models within 8" may immediately stand up',
                    'whip_of_god' => 'May attack friendly models within 1". Each friendly model taken Out of Action adds dice to next Morale roll',
                    'zealot_strength' => 'May have STRONG keyword for +5 ducats',
                ],
                'lore_text' => 'Protected by their unwavering faith and the saints they revere, they ensure the troops stay on the righteous path.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Communicant',
                'slug' => 'communicant',
                'description' => 'Devotees who consumed the flesh and blood of a Meta-Christ. Strengthened by divine essence, they grow to enormous size and wounds close miraculously.',
                'unit_type' => 'elite',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 2, // +2 Dice
                'ranged' => -3, // -3 Dice (blind)
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
                'starting_equipment' => [
                    'communicant_cross', // Acts as Iron Capirote, Combat Helmet, Gas Mask
                ],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Trench Pilgrims Armoury',
                    'armour' => 'Any armour from Trench Pilgrims Armoury',
                    'equipment' => 'Any equipment from Trench Pilgrims Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'strong' => 'Ignores penalties of weapons with HEAVY keyword',
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'miracle_of_regeneration' => 'At start of each Activation, remove one BLOOD MARKER if any',
                    'bodyguard' => 'May redirect hits against PILGRIM models within 1" to self (excluding BLAST)',
                ],
                'lore_text' => 'Blessed crosses are nailed through their eyes as they see clearer blind. They act as line-breakers and bodyguards.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Shrine Anchorite',
                'slug' => 'shrine-anchorite',
                'description' => 'A colossal suit of machine armour fuelled by diesel and faith. Within its spiked interior, the pilot-monk endures terrible penance, his anguished prayers echoing across the battlefield.',
                'unit_type' => 'elite',
                'role' => 'heavy',
                'movement' => 6,
                'melee' => 2, // +2 Dice
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
                'starting_equipment' => [
                    'anchorite_armour', // -3 Armour built-in
                    'combat_helmet',
                    'catherine_wheel',
                    'bonebreaker_mace',
                ],
                'equipment_options' => [
                    'note' => 'Cannot buy additional equipment - all built into construction',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'tough' => 'Subject to rules for TOUGH creatures',
                    'fear' => 'Causes FEAR in enemies',
                    'strong' => 'Ignores penalties of weapons with HEAVY keyword',
                    'catherine_wheel' => 'One-handed RISKY HEAVY weapon, +1 DICE to hit, rolls 3D6 for injuries',
                    'bonebreaker_mace' => 'One-handed RISKY weapon, +1 DICE to injure, treated as Off-Hand',
                    'broken_on_wheel' => 'Before battle, may break volunteer on wheel for protection (redirects attacks)',
                ],
                'lore_text' => 'A grotesque amalgamation of suffering and devotion that instils fear in heretics, where man and machine herald the demise of all who oppose the Almighty.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // TROOP UNITS - The Faithful
            [
                'name' => 'Trench Pilgrim',
                'slug' => 'trench-pilgrim',
                'description' => 'A holy warrior of the trenches. Considers it his religious duty to make pilgrimage to the sacred battlefields to fight the heretic legions.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 0, // +0 Dice
                'ranged' => 0, // +0 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 30,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 999, // No limit specified
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'iron_capirote',
                ],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Trench Pilgrims Armoury',
                    'armour' => 'Any armour from Trench Pilgrims Armoury',
                    'equipment' => 'Any equipment from Trench Pilgrims Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'resurrection' => 'When dies, may re-buy as Martyr-Penitent for 45 ducats (+1 Melee, -1 DICE on Injury Table)',
                    'zealot_strength' => 'One per warband may have STRONG keyword for +5 ducats',
                ],
                'lore_text' => 'Pilgrims wear the iron capirote to insulate their minds from the horrors of war, marching with prayer on their lips.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Martyr-Penitent',
                'slug' => 'martyr-penitent',
                'description' => 'A Trench Pilgrim resurrected by a Meta-Christ, brought back as a warrior half-way between Heaven and Earth, able to fight once more and feel no pain.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 1, // +1 Dice (improved from death)
                'ranged' => 0, // +0 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 45,
                'upkeep_cost' => 4,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 999, // No limit specified
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'iron_capirote',
                ],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Trench Pilgrims Armoury',
                    'armour' => 'Any armour from Trench Pilgrims Armoury',
                    'equipment' => 'Any equipment from Trench Pilgrims Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'undead_resilience' => 'Attacks against Martyr-Penitent add -1 DICE when rolling on Injury Table',
                    'zealot_strength' => 'May have STRONG keyword for +5 ducats',
                ],
                'lore_text' => 'Sometimes the Seventh Meta-Christ deems a fallen pilgrim worthy and brings them back, able to fight once more.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Ecclesiastic Prisoner',
                'slug' => 'ecclesiastic-prisoner',
                'description' => 'Bound in chains, their minds consumed by desperate resolve, Prisoners surge forward driven by hope that their sacrificial charge will cleanse their tarnished souls.',
                'unit_type' => 'trooper',
                'role' => 'specialist',
                'movement' => 6,
                'melee' => -1, // -1 Dice (manacled arms)
                'ranged' => 0, // N/A (no ranged weapons)
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 20,
                'upkeep_cost' => 2,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 999, // No limit specified
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [
                    'iron_capirote', // Cannot be removed except by Broken on Wheel
                    'manacles',
                ],
                'equipment_options' => [
                    'martyrdom_device' => 'May equip Martyrdom Device for 35 ducats (LIMIT:4, CONSUMABLE)',
                    'note' => 'Cannot equip any other weapons, armour, or equipment',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'awaited' => 'If taken Out of Action by Martyrdom Device, does not count for Morale',
                    'mad_dash' => 'Can add +1 DICE to Dash ACTIONS',
                    'martyrdom_device' => 'BLAST 3" weapon, +1 DICE injuries within 1", prisoner rolls 4D6 for own injury',
                ],
                'lore_text' => 'Either captured enemies of the True Faith or volunteer sinners, each strapped with high explosive to detonate at enemy lines.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Stigmatic Nun',
                'slug' => 'stigmatic-nun',
                'description' => 'Blessed with stigmata and unshakeable faith, these swordmaster nuns are the vanguard of any assault by the holy armies.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 8, // Faster than normal
                'melee' => 1, // +1 Dice
                'ranged' => 1, // +1 Dice
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 50,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 4, // 0-4 limit
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'melee_weapons' => 'Any melee weapon from Trench Pilgrims Armoury',
                    'ranged_weapons' => 'Pistols, Automatic Pistols, Warcrosses only',
                    'armour' => 'Any armour from Trench Pilgrims Armoury',
                    'equipment' => 'Any equipment from Trench Pilgrims Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'blessed_stigmata' => 'At start of Activation, may remove one BLOOD MARKER and convert to BLESSING MARKER',
                    'agile' => 'May take Dash, jump/climb/Diving Charge ACTIONS with +1 DICE',
                ],
                'lore_text' => 'From henceforth let no man trouble me: for I bear in my body the marks of our Lord and Saviour. — Galatians 6:17',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
