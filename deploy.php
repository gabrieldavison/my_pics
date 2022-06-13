<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', '');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('195.201.28.147')->set('deploy_path', '~/myweb');;


// Tasks

task('build', function () {
    cd('{{release_path}}');
    run('npm run build');
});

after('deploy:failed', 'deploy:unlock');
