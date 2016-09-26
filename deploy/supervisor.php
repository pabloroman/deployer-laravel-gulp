<?php

env('bin/supervisorctl', function () {
    return run('which supervisorctl')->toString();
});

task('supervisor:restart', function () {
    run('sudo {{bin/supervisorctl}} restart all');
})->desc('Restart queue listeners');