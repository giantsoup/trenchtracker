<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // run Faction and Warband Faction Seeders
        $this->call([
            FactionSeeder::class,
            WarbandVariantSeeder::class,
            BaseUnitsSeeder::class,
        ]);
    }
}
