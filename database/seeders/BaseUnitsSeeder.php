<?php

namespace Database\Seeders;

use App\Models\Faction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaseUnitsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get faction IDs
        $churchFactionId = Faction::where('slug', 'the-church')->first()?->id;
        $hereticFactionId = Faction::where('slug', 'heretic-legions')->first()?->id;
        
        if (!$churchFactionId || !$hereticFactionId) {
            $this->command->warn('Factions not found. Please run FactionSeeder first.');
            return;
        }

        $baseUnits = [
            // The Church units
            [
                'name' => 'Trench Pilgrim',
                'slug' => 'trench-pilgrim',
                'description' => 'Faithful soldiers of the Church, equipped for brutal trench warfare.',
                'faction_id' => $churchFactionId,
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
                'starting_equipment' => json_encode([
                    'trench_gun',
                    'bayonet',
                    'trench_armor'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['trench_club', 'blessed_blade', 'chain_weapon'],
                    'ranged_weapons' => ['pistol', 'rifle', 'shotgun'],
                    'armor' => ['reinforced_armor', 'blessed_armor'],
                    'equipment' => ['grenades', 'medical_supplies', 'holy_water']
                ]),
                'stat_advancement_options' => json_encode([
                    'melee', 'ranged', 'strength', 'fortitude', 'faith'
                ]),
                'special_rules' => json_encode([
                    'faithful' => 'May spend Blessing markers on faith-based tests',
                    'trench_fighter' => '+1 DICE when fighting in cover'
                ]),
                'lore_text' => 'The backbone of the Church\'s forces, these battle-hardened pilgrims have sworn sacred oaths to reclaim the Holy Land from the forces of darkness.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
            [
                'name' => 'Anchorite',
                'slug' => 'anchorite',
                'description' => 'Elite warrior-monks who have undergone sacred modifications.',
                'faction_id' => $churchFactionId,
                'unit_type' => 'elite',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 7,
                'ranged' => 4,
                'strength' => 5,
                'fortitude' => 5,
                'leadership' => 7,
                'faith' => 8,
                'base_cost' => 75,
                'upkeep_cost' => 8,
                'max_wounds' => 2,
                'min_warband_size' => 5,
                'max_per_warband' => 3,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => json_encode([
                    'blessed_blade',
                    'reinforced_armor',
                    'holy_relic'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['chain_weapon', 'power_weapon', 'blessed_weapons'],
                    'ranged_weapons' => ['bolt_pistol', 'plasma_pistol'],
                    'armor' => ['machine_armor', 'sacred_armor'],
                    'equipment' => ['combat_stimms', 'sacred_oils', 'prayer_beads']
                ]),
                'stat_advancement_options' => json_encode([
                    'movement', 'melee', 'strength', 'fortitude', 'leadership', 'faith'
                ]),
                'special_rules' => json_encode([
                    'fearless' => 'Immune to fear and terror effects',
                    'blessed' => 'Starts each game with 1 Blessing marker',
                    'sacred_warrior' => '+2 DICE against demonic enemies'
                ]),
                'lore_text' => 'These warrior-monks have undergone sacred cybernetic modifications, becoming living weapons in service to the Church.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
            [
                'name' => 'Communicant',
                'slug' => 'communicant',
                'description' => 'Inspiring leaders of the Church\'s forces.',
                'faction_id' => $churchFactionId,
                'unit_type' => 'leader',
                'role' => 'support',
                'movement' => 5,
                'melee' => 6,
                'ranged' => 6,
                'strength' => 4,
                'fortitude' => 4,
                'leadership' => 8,
                'faith' => 9,
                'base_cost' => 85,
                'upkeep_cost' => 10,
                'max_wounds' => 2,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => json_encode([
                    'bolt_pistol',
                    'power_weapon',
                    'carapace_armor',
                    'vox_caster'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['blessed_weapons', 'relic_weapons'],
                    'ranged_weapons' => ['plasma_pistol', 'holy_weapon'],
                    'armor' => ['sacred_armor', 'terminator_armor'],
                    'equipment' => ['banner', 'holy_relic', 'combat_drugs']
                ]),
                'stat_advancement_options' => json_encode([
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership', 'faith'
                ]),
                'special_rules' => json_encode([
                    'leader' => 'Other Church units within 6" gain +1 DICE to leadership tests',
                    'inspiring_presence' => 'Friendly units within 12" may use this model\'s Leadership',
                    'master_tactician' => 'May spend Blessing markers to grant extra actions to nearby allies'
                ]),
                'lore_text' => 'Veteran commanders who have proven their faith through countless battles, inspiring their followers to greater acts of devotion.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
            [
                'name' => 'Penitent',
                'slug' => 'penitent',
                'description' => 'Self-flagellating zealots seeking redemption through pain.',
                'faction_id' => $churchFactionId,
                'unit_type' => 'specialist',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 5,
                'ranged' => 3,
                'strength' => 3,
                'fortitude' => 6,
                'leadership' => 5,
                'faith' => 8,
                'base_cost' => 35,
                'upkeep_cost' => 3,
                'max_wounds' => 1,
                'min_warband_size' => 3,
                'max_per_warband' => 4,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => json_encode([
                    'flail',
                    'sackcloth',
                    'holy_symbol'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['chain_flail', 'barbed_whip', 'blessed_chains'],
                    'equipment' => ['pain_glove', 'hair_shirt', 'flagellant_tools']
                ]),
                'stat_advancement_options' => json_encode([
                    'movement', 'melee', 'fortitude', 'faith'
                ]),
                'special_rules' => json_encode([
                    'pain_tolerance' => 'Ignores first wound taken each game',
                    'zealot' => '+1 DICE to all actions when below half wounds',
                    'terrifying' => 'Enemy units must pass Leadership test to charge this unit'
                ]),
                'lore_text' => 'These self-mortifying zealots believe that through pain and suffering, they can achieve divine grace.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],

            // Heretic Legions units
            [
                'name' => 'Heretic Legionnaire',
                'slug' => 'heretic-legionnaire',
                'description' => 'Corrupted soldiers who have turned from the light.',
                'faction_id' => $hereticFactionId,
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
                'starting_equipment' => json_encode([
                    'corrupted_rifle',
                    'combat_knife',
                    'tattered_armor'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['chainsword', 'cursed_blade', 'daemon_weapon'],
                    'ranged_weapons' => ['autopistol', 'hellgun', 'flamer'],
                    'armor' => ['chaos_armor', 'daemonic_hide'],
                    'equipment' => ['frag_grenades', 'combat_drugs', 'ritual_components']
                ]),
                'stat_advancement_options' => json_encode([
                    'melee', 'ranged', 'strength', 'fortitude', 'leadership'
                ]),
                'special_rules' => json_encode([
                    'corrupted' => 'Immune to fear from demonic sources',
                    'heretic' => 'Takes double damage from blessed weapons',
                    'bloodthirsty' => '+1 DICE in melee if enemy has Blood markers'
                ]),
                'lore_text' => 'Once faithful soldiers, these warriors have been corrupted by the whispers of daemons and turned against their former allies.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
            [
                'name' => 'Chaos Champion',
                'slug' => 'chaos-champion',
                'description' => 'Elite warriors blessed by dark powers.',
                'faction_id' => $hereticFactionId,
                'unit_type' => 'leader',
                'role' => 'assault',
                'movement' => 6,
                'melee' => 7,
                'ranged' => 6,
                'strength' => 5,
                'fortitude' => 5,
                'leadership' => 7,
                'faith' => 2,
                'base_cost' => 90,
                'upkeep_cost' => 12,
                'max_wounds' => 3,
                'min_warband_size' => 0,
                'max_per_warband' => 1,
                'is_leader' => true,
                'is_unique' => false,
                'starting_equipment' => json_encode([
                    'daemon_weapon',
                    'bolt_pistol',
                    'chaos_armor',
                    'dark_relic'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['power_weapons', 'daemon_weapons', 'relic_blades'],
                    'ranged_weapons' => ['plasma_pistol', 'combi_weapons'],
                    'armor' => ['terminator_armor', 'daemonic_armor'],
                    'equipment' => ['chaos_banner', 'mutation', 'daemon_familiar']
                ]),
                'stat_advancement_options' => json_encode([
                    'movement', 'melee', 'ranged', 'strength', 'fortitude', 'leadership'
                ]),
                'special_rules' => json_encode([
                    'dark_leader' => 'Heretic units within 6" gain +1 DICE to leadership tests',
                    'daemonic_vigor' => 'Regenerates 1 wound at start of each turn',
                    'chaos_mutations' => 'May gain random mutations through advancement'
                ]),
                'lore_text' => 'Champions who have proven themselves worthy in the eyes of the dark gods, blessed with unholy power and mutations.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
            [
                'name' => 'Possessed',
                'slug' => 'possessed',
                'description' => 'Mortals inhabited by daemonic entities.',
                'faction_id' => $hereticFactionId,
                'unit_type' => 'elite',
                'role' => 'assault',
                'movement' => 7,
                'melee' => 8,
                'ranged' => 2,
                'strength' => 6,
                'fortitude' => 5,
                'leadership' => 4,
                'faith' => 1,
                'base_cost' => 65,
                'upkeep_cost' => 6,
                'max_wounds' => 2,
                'min_warband_size' => 4,
                'max_per_warband' => 2,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => json_encode([
                    'daemon_claws',
                    'mutated_flesh'
                ]),
                'equipment_options' => json_encode([
                    'mutations' => ['extra_arms', 'wings', 'acidic_blood', 'razor_spines'],
                    'daemon_gifts' => ['unholy_strength', 'supernatural_speed', 'psychic_powers']
                ]),
                'stat_advancement_options' => json_encode([
                    'movement', 'melee', 'strength', 'fortitude'
                ]),
                'special_rules' => json_encode([
                    'daemonic' => 'Immune to poison and disease',
                    'unstable' => 'Roll D6 at start of turn: 1 = lose control for one activation',
                    'terrifying' => 'Enemy units must pass Leadership test to charge',
                    'warp_touched' => 'Ignores armor saves from non-blessed weapons'
                ]),
                'lore_text' => 'These unfortunate souls have become vessels for daemonic entities, their humanity consumed by otherworldly malice.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
            [
                'name' => 'Cultist',
                'slug' => 'cultist',
                'description' => 'Fanatical followers who worship the dark powers.',
                'faction_id' => $hereticFactionId,
                'unit_type' => 'trooper',
                'role' => 'support',
                'movement' => 5,
                'melee' => 4,
                'ranged' => 4,
                'strength' => 3,
                'fortitude' => 3,
                'leadership' => 6,
                'faith' => 2,
                'base_cost' => 25,
                'upkeep_cost' => 2,
                'max_wounds' => 1,
                'min_warband_size' => 0,
                'max_per_warband' => 8,
                'is_leader' => false,
                'is_unique' => false,
                'starting_equipment' => json_encode([
                    'autopistol',
                    'ritual_knife',
                    'robes'
                ]),
                'equipment_options' => json_encode([
                    'melee_weapons' => ['club', 'improvised_weapons', 'sacrificial_blade'],
                    'ranged_weapons' => ['autogun', 'shotgun', 'flamer'],
                    'equipment' => ['explosives', 'ritual_components', 'combat_drugs']
                ]),
                'stat_advancement_options' => json_encode([
                    'melee', 'ranged', 'fortitude', 'leadership'
                ]),
                'special_rules' => json_encode([
                    'expendable' => 'Other Heretic units gain +1 DICE when this unit is sacrificed',
                    'fanatic' => '+1 DICE to leadership tests when within 6" of a Chaos Champion',
                    'ritual_sacrifice' => 'Can be sacrificed to grant benefits to other units'
                ]),
                'lore_text' => 'Desperate civilians and broken soldiers who have turned to dark worship in search of power or salvation.',
                'is_active' => true,
                'source_book' => 'Core Rules v1.6.3',
                'version' => '1.6.3',
            ],
        ];

        foreach ($baseUnits as $unit) {
            DB::table('base_units')->insert(array_merge($unit, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('Base units seeded successfully!');
    }
}
