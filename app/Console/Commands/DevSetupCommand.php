<?php

namespace App\Console\Commands;

use Database\Seeders\AdminUserSeeder;
use Illuminate\Console\Command;

class DevSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up development environment with admin user and other development data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up development environment...');

        // Create admin user
        $this->call('db:seed', ['--class' => AdminUserSeeder::class]);

        $this->info('Development environment setup completed!');
    }
}
