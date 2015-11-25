<?php

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/wordpress/');

// This allows us to have plugins and themes outside the Wordpress root
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_CONTENT_DIR', realpath(ABSPATH . '../wp-content/'));
define('WP_CONTENT_URL', WP_HOME . '/wp-content');
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('UPLOADS', '../wp-uploads');

/**
 * Starting with Wordpress 3.7, minor and security updates are rolled out automatically. Detailed information can be
 * found here: http://make.wordpress.org/core/2013/10/25/the-definitive-guide-to-disabling-auto-updates-in-wordpress-3-7/
 *
 * Depening on the project, environment and deployment strategy it might not be ideal to allow Wordpress to do automatic
 * updates. Possible options are:
 * 1. Checkout the project from a repository. Wordpress will never auto-update.
 * 2. Don't allow file modifications through the admin; config: DISALLOW_FILE_MODS
 * 3. Don't allow automatic updates; config: AUTOMATIC_UPDATER_DISABLED
 * 4. Only disable core updates; config: WP_AUTO_UPDATE_CORE
 *
 * Basically only option one and two are relevant for automatically deployed environments.
 */
//define('DISALLOW_FILE_MODS', true);
define('AUTOMATIC_UPDATER_DISABLED', true);
//define('WP_AUTO_UPDATE_CORE', true);    // major and minor updates
//define('WP_AUTO_UPDATE_CORE', false);   // no updates at all
//define('WP_AUTO_UPDATE_CORE', 'minor'); // only minor updates

// Load the real Wordpress config
require_once(ABSPATH . 'wp-config-base.php');
