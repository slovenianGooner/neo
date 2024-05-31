<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\info as info;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class MakeEnvCommand extends Command
{
    protected $signature = 'env:setup';

    protected $description = 'Populate the .env file with the necessary environment variables.';

    public function handle(): void
    {
        $folderName = basename(getcwd());
        $projectName = text('Enter the project name', default: $folderName);

        if (!file_exists('.env')) {
            copy('.env.example', '.env');
            info('Created .env file.');
        }

        // Replace APP_NAME={project_name} in .env
        file_put_contents('.env', preg_replace('/APP_NAME=(.*)/', 'APP_NAME=' . $projectName, file_get_contents('.env')));

        // Replace APP_URL={app_url} in .env with the name of the folder
        file_put_contents('.env', preg_replace('/APP_URL=(.*)/', 'APP_URL=' . 'http://' . $folderName . '.test', file_get_contents('.env')));

        // Replace DB_DATABASE={database_name} in .env
        $databaseName = text('Enter the database name', default: $projectName);
        file_put_contents('.env', preg_replace('/DB_DATABASE=(.*)/', 'DB_DATABASE=' . $databaseName, file_get_contents('.env')));

        // Remove git folder to squash the git history
        exec('rm -rf .git');

        // Would you like to init a new git repository?
        $newRepository = select('Would you like to init a new git repository? (yes/no)', ['yes', 'no']);
        if ($newRepository === 'yes') {
            exec('git init');
            info('Initialized a new git repository.');
        }
    }
}
