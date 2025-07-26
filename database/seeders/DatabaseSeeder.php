<?php

namespace Database\Seeders;

use Database\Seeders\Factions\CourtOfSevenHeadedSerpentSeeder;
use Database\Seeders\Factions\CultOfTheBlackGrailSeeder;
use Database\Seeders\Factions\HereticLegionsSeeder;
use Database\Seeders\Factions\IronSultanateSeeder;
use Database\Seeders\Factions\PrincipalityOfNewAntiochSeeder;
use Database\Seeders\Factions\TrenchPilgrimsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run rules system seeders first (required for other seeders)
        $this->call([
            RulePhaseSeeder::class,
            RuleVersionSeeder::class,
            RuleSeeder::class,
            KeywordSeeder::class,
            ConstraintTypeSeeder::class,
            // EquipmentSeeder::class, // Skipped as requested
        ]);

        // Run individual faction seeders
        $this->call([
            TrenchPilgrimsSeeder::class,
            HereticLegionsSeeder::class,
            CultOfTheBlackGrailSeeder::class,
            CourtOfSevenHeadedSerpentSeeder::class,
            IronSultanateSeeder::class,
            PrincipalityOfNewAntiochSeeder::class,
        ]);
    }
}
