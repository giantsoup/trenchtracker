<?php

namespace Database\Seeders;

use App\Models\Faction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            // The Church - Example unit
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
            ],

            // Heretic Legions - Example unit
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
