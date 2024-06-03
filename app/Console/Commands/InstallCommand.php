<?php

namespace App\Console\Commands;

use Filament\Support\Colors\Color;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use function Laravel\Prompts\info as info;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install {--fresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info('Welcome to the [neo] installation.');

        // Generate application key
        $this->call('key:generate');

        // Remove storage link
        if (file_exists('public/storage')) {
            exec('rm public/storage');
        }

        // Link storage
        $this->call('storage:link');

        // Migrate database
        if ($this->option('fresh')) {
            $this->call('migrate:fresh');
        } else {
            $this->call('migrate');
        }

        // Create a Filament user
        info('Creating an admin user...');
        $this->call('filament:user');

        // Choose the primary color for the admin panel
        $colors = Color::all();
        $primaryColor = select(
            label: 'Choose the primary color for the admin panel',
            options: collect(array_keys($colors))->mapWithKeys(fn($color) => [$color => Str::title($color)])->toArray(),
            default: config('neo.primary_color'),
            hint: 'You can change this later in the .env file'
        );

        // Replace NEO_PRIMARY_COLOR={primary_color} in .env
        file_put_contents('.env', preg_replace('/NEO_PRIMARY_COLOR=(.*)/', 'NEO_PRIMARY_COLOR=' . $primaryColor, file_get_contents('.env')));

        // Run npm install & build
        if (file_exists('package.json')) {

            // Delete node_modules
            if (file_exists('node_modules')) {
                exec('rm -rf node_modules');
            }

            info('Installing NPM dependencies...');
            exec('npm install');
            info('Building assets...');
            exec('npm run build');
        }
    }
}
