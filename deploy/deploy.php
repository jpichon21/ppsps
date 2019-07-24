<?php

    namespace Deployer;
    
    require 'recipe/composer.php';
    require 'recipe/common.php';

    set('repository', 'git@gitlab.com:logomotion/ppsps.git');
    set('git_tty', false);
    set('default_stage', 'dev');
    set('shared_files', ['public/.htaccess', 'public/robots.txt', '.env.local']);
    set('shared_dirs', ['var/logs', 'vendor']);
    set('bin/php', '/usr/local/bin/ea-php72 -c deploy/deploy.ini');

    host('ppsps-staging.logomotion.fr')
        ->stage('staging')
        ->user('root')
        ->hostname('ns4.logomotion-serveur.com')
        ->port('2222')
        ->set('account_dir', 'rougeot')
        ->set('branch', 'staging')
        ->set('deploy_path', '/home/{{account_dir}}/ppsps_staging');

    host('ppsps-dev.logomotion.fr')
        ->stage('dev')
        ->user('root')
        ->hostname('ns4.logomotion-serveur.com')
        ->port('2222')
        ->set('account_dir', 'rougeot')
        ->set('branch', 'dev')
        ->set('deploy_path', '/home/{{account_dir}}/ppsps_dev');

    host('ppspsbyrougeot.com')
        ->stage('prod')
        ->user('root')
        ->hostname('ns4.logomotion-serveur.com')
        ->port('2222')
        ->set('account_dir', 'rougeot')
        ->set('branch', 'master')
        ->set('deploy_path', '/home/{{account_dir}}/ppsps_prod');

    task('deploy', [
        'deploy:info',
        'deploy:prepare',
        'deploy:lock',
        'deploy:release',
        'deploy:update_code',
        'deploy:shared',
        'deploy:writable',
        'deploy:clear_paths',
        'deploy:symlink',
        'deploy:unlock',
        'install',
        'database-migrate',
        'permissions',
        'project-cleanup',
        'cleanup',
        'success'
    ]);

    task('project-cleanup', function () {
        run('rm -rf script/');
        run('rm -rf deploy/');
        run('rm -f docker-compose.yml .vscode/settings.json .gitlab-ci.yml .gitignore .env.dist');
    });

    task('database-migrate', function () {
        run('cd {{release_path}} && {{bin/php}} bin/console doctrine:schema:update --force');
    });
    task('install', function () {
        run('cd {{release_path}} && curl -sS https://getcomposer.org/installer | {{bin/php}}');
        run('cd {{release_path}} && export SYMFONY_ENV=prod');
        run('rm -rf vendor/*');
        run('cd {{release_path}} && {{bin/php}} composer.phar install --optimize-autoloader');
        run('cd {{release_path}} && {{bin/php}} bin/console cache:clear --env=prod');
        run('cd {{release_path}} && {{bin/php}} bin/console assets:install --env=prod');
    });

    task('permissions', function () {
        run('find {{deploy_path}} -type d -exec chmod 755 {} +');
        run('find {{deploy_path}} -type f -exec chmod 644 {} +');
        run('chown -R {{account_dir}}:{{account_dir}} {{deploy_path}}');
    });

    after('deploy:failed', 'deploy:unlock');
