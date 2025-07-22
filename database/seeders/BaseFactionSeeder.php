<?php

namespace Database\Seeders;

use App\Models\BaseUnit;
use App\Models\Faction;
use App\Models\WarbandVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Base abstract seeder class for Trench Crusade factions.
 *
 * This class provides a standardized structure for seeding faction data
 * including factions, warband variants, and base units. Each faction
 * seeder should extend this class and implement the abstract methods.
 *
 * Game Rules Version: 1.6.3
 */
abstract class BaseFactionSeeder extends Seeder
{
    /**
     * Current game rules version being implemented
     */
    protected string $version = '1.6.3';

    /**
     * Get faction data for this seeder
     *
     * @return array Faction data array matching Faction model fillable fields
     */
    abstract protected function getFactionData(): array;

    /**
     * Get warband variants for this faction
     *
     * @return array Array of warband variant data
     */
    abstract protected function getWarbandVariants(): array;

    /**
     * Get base units for this faction
     *
     * @return array Array of base unit data
     */
    abstract protected function getBaseUnits(): array;

    /**
     * Run the database seeds.
     *
     * This method orchestrates the seeding process by creating the faction,
     * its warband variants, and base units in the correct order within a
     * database transaction to ensure data integrity.
     *
     * @throws Throwable
     */
    public function run(): void
    {
        DB::transaction(function () {
            $faction = $this->createFaction();
            $this->createWarbandVariants($faction);
            $this->createBaseUnits($faction);
        });
    }

    /**
     * Create or update the faction
     *
     * Uses updateOrCreate to ensure idempotent seeding operations.
     * The faction slug is used as the unique identifier.
     *
     * @return Faction The created or updated faction instance
     */
    protected function createFaction(): Faction
    {
        $factionData = $this->getFactionData();

        return Faction::updateOrCreate(
            ['slug' => $factionData['slug']],
            $factionData
        );
    }

    /**
     * Create or update warband variants for the faction
     *
     * @param  Faction  $faction  The faction instance to associate variants with
     */
    protected function createWarbandVariants(Faction $faction): void
    {
        $variants = $this->getWarbandVariants();

        foreach ($variants as $variantData) {
            // Ensure faction_id is set
            $variantData['faction_id'] = $faction->id;

            WarbandVariant::updateOrCreate(
                ['slug' => $variantData['slug']],
                $variantData
            );
        }
    }

    /**
     * Create or update base units for the faction
     *
     * @param  Faction  $faction  The faction instance to associate units with
     */
    protected function createBaseUnits(Faction $faction): void
    {
        $baseUnits = $this->getBaseUnits();

        foreach ($baseUnits as $unitData) {
            // Ensure faction_id is set
            $unitData['faction_id'] = $faction->id;

            // Add version to unit data
            $unitData['version'] = $this->version;

            BaseUnit::updateOrCreate(
                ['slug' => $unitData['slug']],
                $unitData
            );
        }
    }
}
