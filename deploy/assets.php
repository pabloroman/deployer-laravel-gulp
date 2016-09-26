<?php

env('bin/npm', function () {
    return run('which npm')->toString();
});

task('npm:install', function () {
    $npm_folder_exists = run('if [ ! -L {{deploy_path}}/shared/node_modules ] && [ -d {{deploy_path}}/shared/node_modules ]; then echo true; fi')->toBool();
    if(!$npm_folder_exists) {
        run('cd {{deploy_path}}/current; {{bin/npm}} install');
        run('mv {{deploy_path}}/current/node_modules  {{deploy_path}}/shared');
    }
    run('ln -s {{deploy_path}}/shared/node_modules {{deploy_path}}/current');
})->desc('Execute npm install');

task('assets:generate', function () {
    run('cd {{deploy_path}}/current; gulp --prod');
})->desc('Generating assets');

task('env:link', function () {
    run('ln -s {{deploy_path}}/shared/environment {{deploy_path}}/current/.env');
})->desc('Symlink environment file');

task('log:set-permissions', function () {
    run('sudo chmod 664 {{deploy_path}}/current/storage/logs/laravel.log');
})->desc('Make laravel.log readable by the web server');
