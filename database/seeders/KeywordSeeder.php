<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\KeywordType;
use App\Models\KeywordVersionEntry;
use App\Models\RuleVersion;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure we have keyword types
        $globalType = KeywordType::updateOrCreate(
            ['name' => 'Global'],
            ['name' => 'Global', 'scope' => 'global']
        );

        $equipmentType = KeywordType::updateOrCreate(
            ['name' => 'Equipment'],
            ['name' => 'Equipment', 'scope' => 'equipment']
        );

        $unitType = KeywordType::updateOrCreate(
            ['name' => 'Unit'],
            ['name' => 'Unit', 'scope' => 'unit']
        );

        // Get the base version for creating version entries
        $baseVersion = RuleVersion::where('version_number', '1.6.3')->first();

        if (! $baseVersion) {
            $this->command->error('Base version 1.6.3 not found. Please run RuleVersionSeeder first.');

            return;
        }

        $keywords = [
            [
                'name' => 'BLAST',
                'keyword_type_id' => $globalType->id,
                'description_markdown' => 'Weapons with BLAST affect an area rather than a single target.',
                'rule_text_markdown' => 'When attacking with a BLAST weapon, all models within 2" of the target are also hit. Roll to wound each model separately.',
                'examples' => ['Artillery Witch Infernal Bomb', 'Grenade Launcher'],
            ],
            [
                'name' => 'HEAVY',
                'keyword_type_id' => $equipmentType->id,
                'description_markdown' => 'Heavy weapons require setup time and restrict movement.',
                'rule_text_markdown' => 'A model with a HEAVY weapon cannot move and shoot in the same turn. If the model moves, it cannot use HEAVY weapons that turn.',
                'examples' => ['Heavy Machine Gun', 'Artillery Cannon'],
            ],
            [
                'name' => 'RISKY',
                'keyword_type_id' => $equipmentType->id,
                'description_markdown' => 'Risky weapons have a chance to malfunction or harm the user.',
                'rule_text_markdown' => 'When rolling to hit with a RISKY weapon, if you roll a natural 1, the weapon misfires. Roll a D6: on a 1-2, the wielder takes 1 wound.',
                'examples' => ['Experimental Plasma Rifle', 'Unstable Explosive'],
            ],
            [
                'name' => 'FIRE',
                'keyword_type_id' => $globalType->id,
                'description_markdown' => 'Fire weapons can set targets ablaze.',
                'rule_text_markdown' => 'When a model is wounded by a FIRE weapon, place a fire token next to it. At the start of each turn, roll a D6 for each fire token: on a 4+, the model takes 1 wound.',
                'examples' => ['Flamethrower', 'Incendiary Grenade'],
            ],
            [
                'name' => 'ELITE',
                'keyword_type_id' => $unitType->id,
                'description_markdown' => 'Elite units are highly trained and experienced.',
                'rule_text_markdown' => 'ELITE models gain +1 to all Leadership tests and may re-roll failed Morale checks.',
                'examples' => ['Templar Knight', 'Veteran Sergeant'],
            ],
            [
                'name' => 'TOUGH',
                'keyword_type_id' => $unitType->id,
                'description_markdown' => 'Tough units are harder to wound.',
                'rule_text_markdown' => 'TOUGH models reduce all incoming damage by 1 (to a minimum of 1).',
                'examples' => ['Armored Crusader', 'Demonic Beast'],
            ],
            [
                'name' => 'FEAR',
                'keyword_type_id' => $unitType->id,
                'description_markdown' => 'Fear-inducing units cause terror in their enemies.',
                'rule_text_markdown' => 'Enemy models within 6" of a FEAR model must pass a Leadership test before charging or shooting at it.',
                'examples' => ['Demon Prince', 'Undead Horror'],
            ],
            [
                'name' => 'INFILTRATOR',
                'keyword_type_id' => $unitType->id,
                'description_markdown' => 'Infiltrators can deploy in advanced positions.',
                'rule_text_markdown' => 'INFILTRATOR models may be deployed anywhere on the battlefield that is more than 12" from enemy models.',
                'examples' => ['Scout', 'Assassin'],
            ],
            [
                'name' => 'CUMBERSOME',
                'keyword_type_id' => $equipmentType->id,
                'description_markdown' => 'Cumbersome equipment slows down the user.',
                'rule_text_markdown' => 'Models with CUMBERSOME equipment reduce their Movement by 1" (to a minimum of 1").',
                'examples' => ['Heavy Armor', 'Large Shield'],
            ],
        ];

        foreach ($keywords as $keywordData) {
            $keyword = Keyword::updateOrCreate(
                ['name' => $keywordData['name']],
                $keywordData
            );

            // Create version entry for this keyword
            KeywordVersionEntry::updateOrCreate(
                [
                    'keyword_id' => $keyword->id,
                    'rule_version_id' => $baseVersion->id,
                ],
                [
                    'keyword_id' => $keyword->id,
                    'rule_version_id' => $baseVersion->id,
                    'status' => 'active',
                ]
            );
        }
    }
}
