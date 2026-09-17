<?php
/** Local configuration example. Copy to the project root as wp-config.php. */

define('DB_NAME', 'm-english');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

/* Replace these placeholders before using this configuration outside local development. */
define('AUTH_KEY',         'replace-with-a-unique-local-key');
define('SECURE_AUTH_KEY',  'replace-with-a-unique-local-key');
define('LOGGED_IN_KEY',    'replace-with-a-unique-local-key');
define('NONCE_KEY',        'replace-with-a-unique-local-key');
define('AUTH_SALT',        'replace-with-a-unique-local-key');
define('SECURE_AUTH_SALT', 'replace-with-a-unique-local-key');
define('LOGGED_IN_SALT',   'replace-with-a-unique-local-key');
define('NONCE_SALT',       'replace-with-a-unique-local-key');

$table_prefix = 'wp_';

define('WP_DEBUG', false);

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';
