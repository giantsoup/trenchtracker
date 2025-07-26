<?php

namespace Database\Seeders;

use App\Models\Rule;
use App\Models\RulePhase;
use App\Models\RuleVersion;
use App\Models\RuleVersionEntry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseVersion = RuleVersion::where('version_number', '1.6.3')->first();

        if (! $baseVersion) {
            $this->command->error('Base version 1.6.3 not found. Please run RuleVersionSeeder first.');

            return;
        }

        $phases = RulePhase::all()->keyBy('name');

        // Movement Phase Rules
        $movementRules = [
            [
                'title' => 'Basic Movement',
                'content_markdown' => "Models can move up to their Movement characteristic in inches during the Movement phase.\n\n**Key Points:**\n- Movement is measured from any part of the model's base\n- Models cannot move through enemy models\n- Difficult terrain reduces movement by half",
                'structured_data' => [
                    'movement_type' => 'basic',
                    'restrictions' => ['no_enemy_models', 'difficult_terrain_half'],
                    'measurement' => 'base_to_base',
                ],
            ],
            [
                'title' => 'Charging',
                'content_markdown' => "A model can charge an enemy model if it can reach it with its movement.\n\n**Charging Rules:**\n- Must move into base contact\n- Grants +1 DICE to melee attacks\n- Cannot charge if already in melee combat",
                'structured_data' => [
                    'movement_type' => 'charge',
                    'bonus' => '+1_dice_melee',
                    'restrictions' => ['not_in_melee', 'base_contact_required'],
                ],
            ],
        ];

        // Shooting Phase Rules
        $shootingRules = [
            [
                'title' => 'Ranged Attacks',
                'content_markdown' => "Models with ranged weapons can make shooting attacks during the Shooting phase.\n\n**Shooting Rules:**\n- Roll dice equal to the weapon's DICE value\n- Target must be within range and line of sight\n- Cover provides -1 DICE penalty to attacker",
                'structured_data' => [
                    'attack_type' => 'ranged',
                    'requirements' => ['line_of_sight', 'within_range'],
                    'cover_penalty' => -1,
                ],
            ],
            [
                'title' => 'Line of Sight',
                'content_markdown' => "To shoot at a target, you must have clear line of sight from the shooter to the target.\n\n**Line of Sight Rules:**\n- Draw imaginary line from shooter's base to target's base\n- Intervening models or terrain block line of sight\n- Models can see over terrain shorter than themselves",
                'structured_data' => [
                    'measurement' => 'base_to_base',
                    'blocking' => ['models', 'terrain'],
                    'height_advantage' => true,
                ],
            ],
        ];

        // Melee Phase Rules
        $meleeRules = [
            [
                'title' => 'Melee Combat',
                'content_markdown' => "Models in base contact can fight in melee during the Melee phase.\n\n**Melee Rules:**\n- Both models roll dice simultaneously\n- Higher total wins the combat\n- Winner can push back or wound the loser",
                'structured_data' => [
                    'attack_type' => 'melee',
                    'resolution' => 'simultaneous',
                    'victory_condition' => 'higher_total',
                ],
            ],
            [
                'title' => 'Injury Rolls',
                'content_markdown' => "When a model is wounded, roll 2D6 on the Injury Chart to determine the result.\n\n**Injury Results:**\n- 2-7: Flesh Wound (model continues fighting)\n- 8-10: Down (model falls prone)\n- 11-12: Out of Action (model is removed)",
                'structured_data' => [
                    'dice' => '2d6',
                    'results' => [
                        'flesh_wound' => '2-7',
                        'down' => '8-10',
                        'out_of_action' => '11-12',
                    ],
                ],
            ],
        ];

        // Campaign Rules
        $campaignRules = [
            [
                'title' => 'Experience Points',
                'content_markdown' => "Models gain experience points (XP) for participating in battles and achieving objectives.\n\n**XP Awards:**\n- Surviving a battle: 1 XP\n- Taking an enemy Out of Action: 2 XP\n- Completing objectives: Variable XP",
                'structured_data' => [
                    'xp_sources' => [
                        'survival' => 1,
                        'enemy_ooa' => 2,
                        'objectives' => 'variable',
                    ],
                ],
            ],
        ];

        // Special Rules
        $specialRules = [
            [
                'title' => 'Fear Test',
                'content_markdown' => "Models must pass a Fear test when charging or being charged by a model with the FEAR keyword.\n\n**Fear Test:**\n- Roll 2D6 + Leadership\n- Need 9+ to pass\n- Failure prevents the action",
                'structured_data' => [
                    'test_type' => 'leadership',
                    'dice' => '2d6',
                    'target_number' => 9,
                    'triggers' => ['charging_fear', 'charged_by_fear'],
                ],
            ],
        ];

        // Create rules for each phase
        $allRules = [
            'Movement' => $movementRules,
            'Shooting' => $shootingRules,
            'Melee' => $meleeRules,
            'Campaign' => $campaignRules,
            'Special Rules' => $specialRules,
        ];

        foreach ($allRules as $phaseName => $rules) {
            $phase = $phases[$phaseName];

            foreach ($rules as $ruleData) {
                $rule = Rule::create([
                    'title' => $ruleData['title'],
                    'slug' => Str::slug($ruleData['title']),
                    'content_markdown' => $ruleData['content_markdown'],
                    'structured_data' => $ruleData['structured_data'],
                    'rule_phase_id' => $phase->id,
                    'is_searchable' => true,
                ]);

                // Create version entry linking this rule to the base version
                RuleVersionEntry::create([
                    'rule_id' => $rule->id,
                    'rule_version_id' => $baseVersion->id,
                    'content_override' => null, // Using base content
                    'status' => 'active',
                ]);
            }
        }

        $this->command->info('RuleSeeder completed successfully!');
        $this->command->info('Created sample rules for all phases with version entries.');
    }
}
