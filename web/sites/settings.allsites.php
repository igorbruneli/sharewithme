<?php

// Trusted Host Settings
$settings['trusted_host_patterns'] = array('.*');

// $site_path is made available by Drupal core.
$sites_subdir = basename($site_path);

$databases['default']['default'] = array (
    'database' => 'sharewithme_' . $sites_subdir,
    'username' => 'root',
    'password' => 'root',
    'host' => '127.0.0.1',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
);

$config_directories[CONFIG_SYNC_DIRECTORY] = '../config/'. $sites_subdir . '/sync';

$settings['install_profile'] = 'standard';

if (file_exists(__DIR__ . '/settings.allsites.local.php')) {
 include __DIR__ . '/settings.allsites.local.php';
}
