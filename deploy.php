<?php

require_once 'recipe/common.php';
require_once __DIR__ . '/deploy/laravel.php';
require_once __DIR__ . '/deploy/assets.php';
require_once __DIR__ . '/deploy/supervisor.php';

// Specify the repository from which to download your project's code.
// The server needs to have git installed for this to work.
// If you're not using a forward agent, then the server has to be able to clone
// your project from this repository.
set('repository', 'your-repository-url');

// Define a server for deployment.
server('production', 'your-server-ip-address', 22)
    ->user('your-server-user')
    ->forwardAgent() // You can use identity key, ssh config, or username/password to auth on the server.
    ->stage('production')
    ->env('deploy_path', 'your-deploy-path'); // Define the base path to deploy your project to.

// Laravel shared dirs
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);


/**
 * Main task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'deploy:symlink',
    'env:link',
    'artisan:migrate',
    'artisan:cache:clear',
    'npm:install',
    'assets:generate',
    'log:set-permissions',
    'supervisor:restart',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
