<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Keyword;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This seeder creates sample equipment from the Heretic Legion faction
     * to demonstrate how equipment data should be structured and stored.
     *
     * Equipment Structure Explanation:
     * - name: The display name of the equipment
     * - type: Category type (melee_weapon, ranged_weapon, armor, equipment)
     * - category_id: Links to EquipmentCategory for organization
     * - base_cost: Array with cost structure (ducats, glory_points, limits)
     * - stats: Array containing game statistics (range, modifiers, etc.)
     * - lore_markdown: Rich text description for display
     *
     * After creating equipment, we attach relevant keywords using the
     * morphToMany relationship through the keywordables pivot table.
     */
    public function run(): void
    {
        // First, ensure we have equipment categories
        $meleeWeaponsCategory = EquipmentCategory::updateOrCreate(
            ['slug' => 'melee-weapons'],
            [
                'name' => 'Melee Weapons',
                'slug' => 'melee-weapons',
                'parent_id' => null,
                'sort_order' => 1,
            ]
        );

        $specialWeaponsCategory = EquipmentCategory::updateOrCreate(
            ['slug' => 'special-weapons'],
            [
                'name' => 'Special Weapons',
                'slug' => 'special-weapons',
                'parent_id' => null,
                'sort_order' => 2,
            ]
        );

        // Get keywords that we'll attach to equipment
        $fireKeyword = Keyword::where('name', 'FIRE')->first();
        $riskyKeyword = Keyword::where('name', 'RISKY')->first();
        $criticalKeyword = Keyword::where('name', 'CRITICAL')->first();
        $cumbersomeKeyword = Keyword::where('name', 'CUMBERSOME')->first();

        // Sample Equipment from Heretic Legion
        $equipment = [
            [
                'name' => 'Hellblade',
                'type' => 'melee_weapon',
                'category_id' => $specialWeaponsCategory->id,
                'base_cost' => [
                    'ducats' => 0,
                    'glory_points' => 2,
                    'limit' => null,
                    'restrictions' => ['ELITE only'],
                ],
                'stats' => [
                    'weapon_type' => '2-handed',
                    'range' => 'Melee',
                    'modifiers' => ['+1 DICE to Injuries'],
                    'special_rules' => [
                        'The Hellblade has +1 DICE when rolling for injuries.',
                        'It also has the Keyword FIRE, so it causes an additional +1 BLOOD MARKER on enemies it hits.',
                    ],
                ],
                'lore_markdown' => 'Crafted from iron ore from the mines of Dis, this weapon burns with the unquenchable fires of Hell.',
                'keywords' => [$fireKeyword],
            ],
            [
                'name' => 'Tartarus Claws',
                'type' => 'melee_weapon',
                'category_id' => $specialWeaponsCategory->id,
                'base_cost' => [
                    'ducats' => 0,
                    'glory_points' => 3,
                    'limit' => null,
                    'restrictions' => ['ELITE only'],
                ],
                'stats' => [
                    'weapon_type' => '2-handed',
                    'range' => 'Melee',
                    'modifiers' => [],
                    'special_rules' => [
                        'Tartarus Claws always come as a pair and do not allow the use of any other melee weapons or shield.',
                        'You can make two Attack ACTIONS with the Claws without the usual -1 DICE for the second attack.',
                        'If the opponent is taken Down or Out of Action with either of the Claws you may immediately move the model up to 6" in any direction.',
                        'If the move takes you into contact with another enemy model, this counts as a charge and you can make a second Melee Attack ACTION with both claws.',
                        'You can only do this follow-up move once per Activation.',
                    ],
                ],
                'lore_markdown' => 'Made from the severed hands of Malebranche, Tartarus Claws are granted by Arch-Devils only to those whose hearts are blackened with the sin of wrath.',
                'keywords' => [$cumbersomeKeyword],
            ],
            [
                'name' => 'Blasphemous Staff',
                'type' => 'melee_weapon',
                'category_id' => $specialWeaponsCategory->id,
                'base_cost' => [
                    'ducats' => 0,
                    'glory_points' => 2,
                    'limit' => null,
                    'restrictions' => ['ELITE only'],
                ],
                'stats' => [
                    'weapon_type' => '1-handed',
                    'range' => 'Melee',
                    'modifiers' => [],
                    'special_rules' => [
                        'Gives +1 DICE bonus to any other ACTION the model takes apart from Dash, Ranged Attack or Melee Attack.',
                    ],
                ],
                'lore_markdown' => 'Made in mockery of the rod carried by the Prophet Aaron, the slightest touch from this evil staff causes unimaginable agony.',
                'keywords' => [$fireKeyword, $criticalKeyword],
            ],
            [
                'name' => 'Sacrificial Knife',
                'type' => 'melee_weapon',
                'category_id' => $specialWeaponsCategory->id,
                'base_cost' => [
                    'ducats' => 0,
                    'glory_points' => 1,
                    'limit' => 2,
                    'restrictions' => [],
                ],
                'stats' => [
                    'weapon_type' => '1-handed',
                    'range' => 'Melee',
                    'modifiers' => ['+2 on injury results'],
                    'special_rules' => [
                        'The Sacrificial Knife adds +2 to all rolls on the Injury Chart.',
                        'For example, a roll of 7 on the Injury Chart becomes 9 when using the Sacrificial Knife.',
                    ],
                ],
                'lore_markdown' => 'Terrifying blades blessed by the hand of a greater devil, these knives are used in Heretic rituals to sacrifice captives to the dark powers of Hell. They simply need to touch their opponents to cause indescribable pain and even the slightest wound often proves fatal. They are risky even to their wielders, as the merest scratch wounds friend and foe alike.',
                'keywords' => [$riskyKeyword],
            ],
        ];

        // Get constraint types for creating constraints
        $unitTypeRestriction = ConstraintType::where('slug', 'unit-type-restriction')->first();
        $warbandLimit = ConstraintType::where('slug', 'warband-limit')->first();

        foreach ($equipment as $equipmentData) {
            // Extract keywords and constraints info before creating equipment
            $keywords = $equipmentData['keywords'] ?? [];
            $restrictions = $equipmentData['base_cost']['restrictions'] ?? [];
            $limit = $equipmentData['base_cost']['limit'] ?? null;
            unset($equipmentData['keywords']);

            $equipmentItem = Equipment::updateOrCreate(
                ['name' => $equipmentData['name']],
                $equipmentData
            );

            // Attach keywords to equipment
            if (! empty($keywords)) {
                $keywordIds = collect($keywords)->filter()->pluck('id')->toArray();
                if (! empty($keywordIds)) {
                    $equipmentItem->keywords()->sync($keywordIds);
                }
            }

            // Create constraints based on restrictions
            if (! empty($restrictions) && $unitTypeRestriction) {
                foreach ($restrictions as $restriction) {
                    Constraint::updateOrCreate([
                        'constrainable_type' => Equipment::class,
                        'constrainable_id' => $equipmentItem->id,
                        'constraint_type_id' => $unitTypeRestriction->id,
                        'description_markdown' => $restriction,
                    ], [
                        'conditions' => ['unit_type' => strtolower(str_replace(' only', '', $restriction))],
                        'is_restriction' => true,
                        'applies_to' => 'unit',
                    ]);
                }
            }

            // Create warband limit constraint if applicable
            if ($limit && $warbandLimit) {
                Constraint::updateOrCreate([
                    'constrainable_type' => Equipment::class,
                    'constrainable_id' => $equipmentItem->id,
                    'constraint_type_id' => $warbandLimit->id,
                    'description_markdown' => "Maximum {$limit} per warband",
                ], [
                    'conditions' => ['max_count' => $limit],
                    'is_restriction' => true,
                    'applies_to' => 'warband',
                ]);
            }
        }

        $this->command->info('Equipment seeder completed successfully!');
        $this->command->info('Created sample equipment from Heretic Legion faction:');
        $this->command->info('- Hellblade (2-handed melee weapon with FIRE keyword)');
        $this->command->info('- Tartarus Claws (2-handed melee weapon with CUMBERSOME keyword)');
        $this->command->info('- Blasphemous Staff (1-handed melee weapon with FIRE and CRITICAL keywords)');
        $this->command->info('- Sacrificial Knife (1-handed melee weapon with RISKY keyword)');
        $this->command->info('');
        $this->command->info('Data Structure Notes:');
        $this->command->info('- base_cost: Contains ducats, glory_points, limits, and restrictions');
        $this->command->info('- stats: Contains weapon_type, range, modifiers, and special_rules');
        $this->command->info('- lore_markdown: Rich text for display purposes');
        $this->command->info('- Keywords attached via morphToMany relationship');
    }
}
