<?php

namespace Database\Seeders;

use App\Models\RuleVersion;
use Illuminate\Database\Seeder;

class RuleVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $versions = [
            [
                'version_number' => '1.6.3',
                'type' => 'base',
                'release_date' => '2024-01-01',
                'is_active' => true,
                'pdf_path' => null,
                'notes' => 'Base rules version 1.6.3 - Core Trench Crusade rulebook',
            ],
            [
                'version_number' => 'Errata 2024-01-15',
                'type' => 'errata',
                'release_date' => '2024-01-15',
                'is_active' => true,
                'pdf_path' => null,
                'notes' => 'Errata update for version 1.6.3 - Bug fixes and clarifications',
            ],
        ];

        foreach ($versions as $versionData) {
            RuleVersion::updateOrCreate(
                ['version_number' => $versionData['version_number']],
                $versionData
            );
        }
    }
}
