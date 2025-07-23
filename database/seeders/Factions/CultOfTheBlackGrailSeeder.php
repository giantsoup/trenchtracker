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
            [
                'name' => 'Dirge of the Great Hegemon',
                'slug' => 'dirge-of-the-great-hegemon',
                'description' => 'Shattered remains of once-mighty legions of fallen Hegemons, forming everlasting funeral processions for their dead masters.',
                'special_rules' => 'The Executor (Plague Knight with TOUGH and +1 Ranged), The Lamenters (up to 3 Plague Knights), The Fallen (no Lord of Tumours or Amalgam), The Lost (max 2 Hounds/Wailers and 2 Heralds/Weepers), The Bereaved (Thralls with +0 Ranged, 30 ducats, Grail Thralls can use ranged weapons), Dishonoured (no Black Grail Shield or Beelzebub\'s Axe), Hegemon\'s Last Blessing (Plague Blade/Putrid Shotgun/Viscera Cannon LIMIT: 3 each, non-ELITE can use Viscera Cannons), Hegemon\'s Will (Plague Knights can command Thralls by removing INFECTION MARKERS).',
                'icon' => 'skull',
                'starting_resources' => [
                    'ducats' => 700,
                    'broken_relics' => 2,
                    'bitter_ashes' => 1,
                ],
                'unit_restrictions' => [
                    'must_include_executor' => 1,
                    'max_plague_knights' => 3,
                    'max_hounds' => 2,
                    'max_heralds' => 2,
                    'no_lord_of_tumours' => true,
                    'no_amalgam' => true,
                ],
                'equipment_restrictions' => [
                    'special_access' => ['broken_crown', 'urn_of_bitter_ashes', 'blunderbuss'],
                    'banned' => ['black_grail_shield', 'beelzebubs_axe'],
                    'enhanced_limits' => ['plague_blade_3', 'putrid_shotgun_3', 'viscera_cannon_3'],
                ],
                'is_active' => true,
                'sort_order' => 3,
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
            // ELITE UNITS - THE ORDER OF THE FLY
            [
                'name' => 'Lord of Tumours',
                'slug' => 'lord-of-tumours',
                'description' => 'A high-ranking noble officiant in the Cult of the Black Grail, the Lord of Tumours spreads filth and corruption amongst friend and foe alike.',
                'unit_type' => 'elite',
                'role' => 'leader',
                'movement' => 6,
                'melee' => 4, // +4 DICE
                'ranged' => 1, // +1 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 130,
                'upkeep_cost' => 13,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Black Grail Armoury',
                    'armour' => 'Any armour from Black Grail Armoury',
                    'equipment' => 'Any equipment from Black Grail Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'beelzebubs_touch' => 'If a melee attack hits and causes at least one BLOOD/INFECTION MARKER, inflicts an additional INFECTION MARKER. Empty hands count as Trench Clubs.',
                    'undead_fortitude' => 'Non-FIRE injuries rolled with -1 DICE. Ignores additional BLOOD MARKERS from GAS keyword.',
                    'tough' => 'Subject to the rules for TOUGH Creatures.',
                    'fear' => 'Causes FEAR in enemies.',
                    'strong' => 'Ignores HEAVY keyword penalties on weapons.',
                ],
                'lore_text' => 'They commune with the Lord of the Flies through a trance-like ecstasy and can channel the very power of the seventh circle of Hell which Beelzebub rules.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Plague Knight',
                'slug' => 'plague-knight',
                'description' => 'Ranking lowliest in the nobility of the Black Grail, these armoured great warriors were once truly depraved worshippers of Beelzebub.',
                'unit_type' => 'elite',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 2, // +2 DICE
                'ranged' => 0, // +0 DICE
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
                    'weapons' => 'Any weapon from Black Grail Armoury',
                    'armour' => 'Any armour from Black Grail Armoury (must have armour)',
                    'equipment' => 'Any equipment from Black Grail Armoury',
                    'ranks' => [
                        'knight_companion_of_the_fly' => '+1 DICE to Ranged or Melee (+5 ducats)',
                        'knight_of_the_rotten_cross' => 'May purchase New Antioch or Heretic Legion weapons (+5 ducats)',
                        'plague_almoner' => 'Requires one less BLOOD/INFECTION MARKER for Bloodbath (+10 ducats)',
                    ],
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'undead_fortitude' => 'Non-FIRE injuries rolled with -1 DICE. Ignores additional BLOOD MARKERS from GAS keyword.',
                    'fear' => 'Causes FEAR in enemies.',
                    'strong' => 'Ignores HEAVY keyword penalties on weapons.',
                ],
                'lore_text' => 'When the Black Grail came for them, they willingly submitted themselves to the authority of the Lord of Flies. They aspire to win favour in the eyes of Beelzebub and one day be promoted in the hierarchy of the Order of the Fly.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Corpse Guard',
                'slug' => 'corpse-guard',
                'description' => 'Only the strongest human devotees can survive the blessings of the Black Grail. The ones that do are inducted into the ranks of the Corpse Guard.',
                'unit_type' => 'elite',
                'role' => 'support',
                'movement' => 6,
                'melee' => 1, // +1 DICE
                'ranged' => 0, // +0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 55,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any weapon from Black Grail Armoury',
                    'armour' => 'Any armour from Black Grail Armoury',
                    'equipment' => 'Any equipment from Black Grail Armoury',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith',
                ],
                'special_rules' => [
                    'parasitic_tick' => 'If inflicting BLOOD/INFECTION MARKERS with melee on non-BLACK GRAIL model, can remove one of own BLOOD/INFECTION MARKERS.',
                    'bodyguard' => 'Can redirect hits from BLACK GRAIL models within 1" to itself (not against BLAST weapons).',
                    'undead_fortitude' => 'Non-FIRE injuries rolled with -1 DICE. Ignores additional BLOOD MARKERS from GAS keyword.',
                    'fear' => 'Causes FEAR in enemies.',
                ],
                'lore_text' => 'Bodyguards to the nobility of the Black Grail. If they serve with distinction, they may one day join the ranks of the Infernal Nobility.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],

            // SERVANTS OF THE BLACK GRAIL
            [
                'name' => 'Hounds of the Black Grail',
                'slug' => 'hounds-of-the-black-grail',
                'description' => 'Parasitic carcasses of canines infested with maggots and flies spawned from the body of Beelzebub himself.',
                'unit_type' => 'specialist',
                'role' => 'assault',
                'movement' => 8,
                'melee' => 1, // +1 DICE
                'ranged' => -99, // N/A - cannot use ranged weapons
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 55,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'special' => 'Cannot be equipped with weapons, armour or equipment. +5 ducats to cause INFECTION MARKERS instead of BLOOD MARKERS with unarmed attacks.',
                ],
                'stat_advancement_options' => [
                    'melee', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    'undead_fortitude' => 'Non-FIRE injuries rolled with -1 DICE. Ignores additional BLOOD MARKERS from GAS keyword.',
                    'frightening_speed' => 'Roll Dash with +1 DICE. No movement penalties after Standing from Down.',
                    'disease_carrier' => 'Enemy models Activated in Melee Combat with Hound suffer one INFECTION MARKER.',
                    'fear' => 'Causes FEAR in enemies.',
                ],
                'lore_text' => 'Their unholy mission is to prowl No Man\'s Land and spread diseases and pestilence in the name of their dark master.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Grail Thrall',
                'slug' => 'grail-thrall',
                'description' => 'Grail Thralls have become almost impervious to pain, joining the endless legions of empty, hollowed-out and diseased husks.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 5,
                'melee' => -1, // -1 DICE
                'ranged' => -99, // N/A - cannot use ranged weapons
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 25,
                'upkeep_cost' => 2,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 99, // Unlimited
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'special' => 'Cannot be equipped with weapons, armour or equipment. Do not suffer penalties for fighting unarmed.',
                ],
                'stat_advancement_options' => [
                    'melee', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    'overwhelming_horde' => 'For each friendly BLACK GRAIL model within 3", gains +1 DICE to Melee attacks (max +4 DICE).',
                    'undead_fortitude' => 'Non-FIRE injuries rolled with -1 DICE. Ignores additional BLOOD MARKERS from GAS keyword.',
                    'fear' => 'Causes FEAR in enemies.',
                ],
                'lore_text' => 'Most are turned into Grail Thralls, and join the endless legions of empty, hollowed-out and diseased husks who must obey the whims of the Black Grail nobles for all eternity.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Fly Thrall',
                'slug' => 'fly-thrall',
                'description' => 'Fly Thralls are controlled by gargantuan hell-flies that have buried their proboscis deep into the central nervous system of their victims.',
                'unit_type' => 'trooper',
                'role' => 'assault',
                'movement' => 6,
                'melee' => -1, // -1 DICE
                'ranged' => -99, // N/A - cannot use ranged weapons
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 25,
                'upkeep_cost' => 2,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 99, // Unlimited
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'special' => 'Cannot be equipped with weapons, armour or equipment. Do not suffer penalties for fighting unarmed. Has Flying movement.',
                ],
                'stat_advancement_options' => [
                    'melee', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    'overwhelming_horde' => 'For each friendly BLACK GRAIL model within 3", gains +1 DICE to Melee attacks (max +4 DICE).',
                    'flying' => 'Has Flying movement type.',
                    'fear' => 'Causes FEAR in enemies.',
                ],
                'lore_text' => 'Allowing far greater mobility in exchange for less resistance to pain. They are slowly eaten from within to be used as fuel by the hell-flies.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Herald of Beelzebub',
                'slug' => 'herald-of-beelzebub',
                'description' => 'Some victims of the Black Grail are bestowed with the black honour by being melded with hell-flies, growing into a grotesque winged insect made of bloated flesh.',
                'unit_type' => 'specialist',
                'role' => 'ranged',
                'movement' => 10,
                'melee' => 0, // +0 DICE
                'ranged' => 0, // +0 DICE
                'strength' => 0,
                'fortitude' => 0,
                'leadership' => 0,
                'faith' => 0,
                'base_cost' => 50,
                'upkeep_cost' => 5,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 4,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Any ranged weapon from Black Grail Armoury',
                    'equipment' => 'Compound Eyes Helmets or single Grail Devotee only',
                    'special' => 'One Herald can have Maddening Buzz ability (+10 ducats)',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    'infected_proboscis' => 'No penalties for unarmed fighting. Unarmed attacks cause INFECTION MARKERS instead of BLOOD MARKERS. If inflicting INFECTION MARKER on non-BLACK GRAIL enemy, can remove one own BLOOD MARKER.',
                    'maddening_buzz' => 'Every ACTION by non-BLACK GRAIL models within 8" is RISKY ACTION (+10 ducats upgrade).',
                    'toxic' => 'Ignores additional BLOOD MARKERS from GAS keyword.',
                    'skirmisher' => 'Can move D3" when targeted by or intercepting Charge (unless in Melee or Down).',
                    'flying' => 'Has Flying movement type.',
                    'fear' => 'Causes FEAR in enemies.',
                ],
                'lore_text' => 'After this torturous metamorphosis they take to air as Heralds of Beelzebub, the winged squires and scouts of the Order of the Fly.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
            [
                'name' => 'Amalgam',
                'slug' => 'amalgam',
                'description' => 'An Amalgam is a huge, shambling mass of dozens of bodies of infected fallen enemy warriors, insects, mammals and any other living creatures.',
                'unit_type' => 'specialist',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 0, // +0 DICE
                'ranged' => 0, // +0 DICE
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
                'starting_equipment' => [],
                'equipment_options' => [
                    'weapons' => 'Six functional arms: can carry six one-handed or three two-handed weapons (any combination). Uses Black Grail Armoury. May carry single trench shield. Cannot carry Grenades. Max two weapons with same name. One Ranged Attack per ranged weapon per Activation. One Melee Attack per melee weapon per Activation.',
                ],
                'stat_advancement_options' => [
                    'melee', 'ranged', 'strength', 'fortitude',
                ],
                'special_rules' => [
                    'corpulent' => 'Injuries rolled with -2 DICE.',
                    'tough' => 'Subject to the rules for TOUGH Creatures.',
                    'toxic' => 'Ignores additional BLOOD MARKERS from GAS keyword.',
                    'trample' => 'Once per Activation, extra Melee Attack against Downed enemy on 32mm or smaller base (as Trench Club, ignores armour).',
                    'unstoppable' => 'Enemies get no free attacks when Retreating. Can move out of Melee using Standard Move, Charge, and Dash.',
                    'fear' => 'Causes FEAR in enemies.',
                    'strong' => 'Two arms have STRONG keyword. Can wield any two HEAVY weapons using one hand each.',
                ],
                'lore_text' => 'These shoggoths shamble across the battlefield like walking mountains of corpulent, diseased flesh, crushing anything unfortunate enough to be in its path into disgusting pulp.',
                'is_active' => true,
                'source_book' => 'Core Rules',
            ],
        ];
    }
}
