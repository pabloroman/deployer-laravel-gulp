<?php

/**
 * Artisan tasks
 */
task('artisan:up', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan up');
    writeln('<info>'.$output.'</info>');
})->desc('Disable maintenance mode');

task('artisan:down', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan down');
    writeln('<error>'.$output.'</error>');
})->desc('Enable maintenance mode');

task('artisan:migrate', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan migrate --force');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan migrate');

task('artisan:migrate:rollback', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan migrate:rollback --force');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan migrate:rollback');

task('artisan:migrate:status', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan migrate:status');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan migrate:status');

task('artisan:db:seed', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan db:seed --force');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan db:seed');

task('artisan:cache:clear', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan cache:clear');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan cache:clear');

task('artisan:config:cache', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan config:cache');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan config:cache');

task('artisan:route:cache', function () {
    $output = run('{{bin/php}} {{deploy_path}}/current/artisan route:cache');
    writeln('<info>' . $output . '</info>');
})->desc('Execute artisan route:cache');
