<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MigrateAll extends Command
{
    protected $signature = 'migrate:all';

    protected $description = 'Migrate all migration files inside multiple folders and root migrations folder';

    public function handle()
    {
        // Seed the database
        Artisan::call('migrate:fresh');

        $migrationFolders = $this->getMigrationFolders();

        foreach ($migrationFolders as $folder) {
            $path = database_path('migrations/'.$folder);
            if (is_dir($path)) {
                Artisan::call('migrate', ['--path' => 'database/migrations/'.$folder]);
            }
        }

        // Migrate root migrations folder (these commands)
        $rootMigrationsPath = database_path('migrations');
        $rootMigrationFiles = File::glob($rootMigrationsPath.'/*.php');
        foreach ($rootMigrationFiles as $file) {
            Artisan::call('migrate', ['--path' => 'database/migrations/'.basename($file)]);
        }

        // Seed the database
        Artisan::call('db:seed');

        $this->info('All migration files have been migrated, and the database has been seeded.');
    }

    private function getMigrationFolders(): array
    {
        $migrationPath = database_path('migrations');
        $migrationFolders = [];

        $folders = File::directories($migrationPath);
        foreach ($folders as $folder) {
            $migrationFolders[] = basename($folder);
        }

        return $migrationFolders;
    }
}
