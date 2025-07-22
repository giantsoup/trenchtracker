<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarbandVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Get faction IDs
        $factionIds = DB::table('factions')->pluck('id', 'slug')->toArray();

        $variants = [
            // Trench Pilgrims Variants
            [
                'faction_id' => $factionIds['trench-pilgrims'],
                'name' => 'Orthodox Brotherhood',
                'slug' => 'orthodox-brotherhood',
                'description' => 'Traditional Trench Pilgrims following orthodox doctrine and tactics.',
                'special_rules' => 'Units gain +1 DICE to Faith-based tests. May recruit Chaplains.',
                'icon' => 'cross-circle',
                'starting_resources' => json_encode([
                    'ducats' => 150,
                    'relics' => 1,
                    'blessing_tokens' => 3,
                ]),
                'unit_restrictions' => json_encode([
                    'max_heretics' => 0,
                    'min_faithful' => 3,
                ]),
                'equipment_restrictions' => json_encode([
                    'banned' => ['cursed_weapons'],
                    'special_access' => ['blessed_ammunition'],
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'faction_id' => $factionIds['trench-pilgrims'],
                'name' => 'Penitent Company',
                'slug' => 'penitent-company',
                'description' => 'Reformed sinners seeking redemption through battle.',
                'special_rules' => 'Units may gain Experience faster but start with reduced stats.',
                'icon' => 'flame',
                'starting_resources' => json_encode([
                    'ducats' => 120,
                    'penitence_markers' => 5,
                ]),
                'unit_restrictions' => json_encode([
                    'max_elite_units' => 2,
                ]),
                'equipment_restrictions' => json_encode([
                    'limited' => ['heavy_armor'],
                ]),
                'is_active' => true,
                'sort_order' => 2,
            ],

            // Heretic Legions Variants
            [
                'faction_id' => $factionIds['heretic-legions'],
                'name' => 'Infernal Cult',
                'slug' => 'infernal-cult',
                'description' => 'Devoted servants of specific demonic entities.',
                'special_rules' => 'May summon Lesser Demons. Units immune to Fear from Infernal sources.',
                'icon' => 'flame-kindling',
                'starting_resources' => json_encode([
                    'ducats' => 130,
                    'soul_tokens' => 2,
                    'ritual_components' => 3,
                ]),
                'unit_restrictions' => json_encode([
                    'min_cultists' => 2,
                    'max_redeemed' => 1,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['demonic_weapons', 'cursed_armor'],
                    'banned' => ['blessed_items'],
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],

            // The Cult of the Black Grail Variants
            [
                'faction_id' => $factionIds['cult-of-the-black-grail'],
                'name' => 'The Blood Chalice Covenant',
                'slug' => 'blood-chalice-covenant',
                'description' => 'Orthodox followers of the Black Grail who practice the most ancient rituals.',
                'special_rules' => 'May consume Blood Markers to enhance abilities. Immune to certain psychological effects.',
                'icon' => 'wine-glass',
                'starting_resources' => json_encode([
                    'ducats' => 125,
                    'corrupted_relics' => 1,
                    'blood_vials' => 4,
                ]),
                'unit_restrictions' => json_encode([
                    'min_acolytes' => 2,
                    'max_pure_units' => 1,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['ritual_daggers', 'unholy_chalices'],
                    'banned' => ['holy_water', 'blessed_symbols'],
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'faction_id' => $factionIds['cult-of-the-black-grail'],
                'name' => 'The Crimson Libation',
                'slug' => 'crimson-libation',
                'description' => 'Extremist sect that practices blood communion and flesh sacrifice.',
                'special_rules' => 'Units regenerate health by consuming enemy blood. Enhanced combat abilities after kills.',
                'icon' => 'droplet',
                'starting_resources' => json_encode([
                    'ducats' => 110,
                    'sacrificial_knives' => 3,
                    'communion_wine' => 2,
                ]),
                'unit_restrictions' => json_encode([
                    'min_blood_priests' => 1,
                    'max_ranged_units' => 3,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['vampiric_weapons', 'blood_armor'],
                    'preferred' => ['melee_weapons'],
                ]),
                'is_active' => true,
                'sort_order' => 2,
            ],

            // The Court of the Seven-Headed Serpent Variants
            [
                'faction_id' => $factionIds['court-of-seven-headed-serpent'],
                'name' => 'The Jade Throne Court',
                'slug' => 'jade-throne-court',
                'description' => 'Traditional aristocratic court that maintains formal hierarchy and ancient protocols.',
                'special_rules' => 'Noble units gain additional command abilities. May field Serpent Familiars.',
                'icon' => 'crown',
                'starting_resources' => json_encode([
                    'ducats' => 175,
                    'serpent_scales' => 3,
                    'noble_seals' => 2,
                ]),
                'unit_restrictions' => json_encode([
                    'min_nobles' => 1,
                    'max_commoners' => 4,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['serpentine_weapons', 'courtly_armor'],
                    'preferred' => ['poison_equipment'],
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'faction_id' => $factionIds['court-of-seven-headed-serpent'],
                'name' => 'The Venom Dukes',
                'slug' => 'venom-dukes',
                'description' => 'Military-focused nobles who have embraced the serpent\'s deadly gifts.',
                'special_rules' => 'All weapons gain poison effects. Enhanced stealth and ambush capabilities.',
                'icon' => 'skull',
                'starting_resources' => json_encode([
                    'ducats' => 150,
                    'venom_vials' => 5,
                    'serpent_totems' => 2,
                ]),
                'unit_restrictions' => json_encode([
                    'min_assassins' => 1,
                    'max_heavy_units' => 2,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['poisoned_blades', 'venom_launchers'],
                    'banned' => ['pure_silver_weapons'],
                ]),
                'is_active' => true,
                'sort_order' => 2,
            ],

            // Iron Sultanate Variants
            [
                'faction_id' => $factionIds['iron-sultanate'],
                'name' => 'Mechanized Division',
                'slug' => 'mechanized-division',
                'description' => 'Heavy emphasis on steam-powered war machines and technology.',
                'special_rules' => 'Reduced equipment malfunction penalties. May field additional vehicles.',
                'icon' => 'cog',
                'starting_resources' => json_encode([
                    'ducats' => 200,
                    'scrap_metal' => 5,
                    'steam_cores' => 2,
                ]),
                'unit_restrictions' => json_encode([
                    'min_engineers' => 1,
                    'max_cavalry' => 1,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['advanced_firearms', 'steam_armor'],
                    'preferred' => ['mechanical_equipment'],
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],

            // The Principality of New Antioch Variants
            [
                'faction_id' => $factionIds['principality-of-new-antioch'],
                'name' => 'Survivor Enclave',
                'slug' => 'survivor-enclave',
                'description' => 'Hardened survivors who have adapted to the harsh realities of endless war.',
                'special_rules' => 'Units gain bonuses when fighting in ruins or trenches. Improved scavenging.',
                'icon' => 'tent',
                'starting_resources' => json_encode([
                    'ducats' => 140,
                    'scavenged_gear' => 4,
                    'survival_supplies' => 3,
                ]),
                'unit_restrictions' => json_encode([
                    'max_nobles' => 0,
                    'min_veterans' => 2,
                ]),
                'equipment_restrictions' => json_encode([
                    'special_access' => ['scavenged_weapons', 'makeshift_armor'],
                    'limited' => ['pristine_equipment'],
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($variants as $variant) {
            DB::table('warband_variants')->insert([
                ...$variant,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
