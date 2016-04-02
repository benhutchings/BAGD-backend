<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'heroku_1cb8a47d675d9ca');

/** MySQL database username */
define('DB_USER', 'b3bac3160fcfd7');

/** MySQL database password */
define('DB_PASSWORD', '14f1bf76');

/** MySQL hostname */
define('DB_HOST', 'eu-cdbr-west-01.cleardb.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[5-=~/<^x}mAf@HWbV/~.>*<T~j(elaW-=nTh|#CV4d}k+t#d-@.%6*|WQ|?moV/');
define('SECURE_AUTH_KEY',  '/wHc%p$Dk+YSXmDyvs!1ZDS$F%G9.`=JtV-XSgbDYe wg3}tW8 4~UP-8w P6FCh');
define('LOGGED_IN_KEY',    'TvGtN/(c-t&D)Sf6{%OLJH`VC}>|[a>r?b0@XE:gcrQ+5U:KzFzyk7t1cE/1Y[qm');
define('NONCE_KEY',        'GqTrq>pr-kGKglGq1I`ZzdcT+0b?Gq=+E|q!0{?I:` iqQHsb?Lg}k`2P;yp(7qN');
define('AUTH_SALT',        'Lf(C{>CK&;nM.LmIeeQ4+bvsM!q||?Q>i- C#BkY6DP0Y]a4#l|n;ShQX1pi!$<M');
define('SECURE_AUTH_SALT', 'GhWU-1Js+40t)juV$[:kOw&ndOq+AI]0eckuE<+?j1C5%AH@G:kzU>k%vaymgj-P');
define('LOGGED_IN_SALT',   'Kg?Nz0jI7MqD_hNeHs}MWf[e]=gKiM#0BKr7uLbe72K$D|[htepp+z00.7)V Vte');
define('NONCE_SALT',       'u&E-5pfC?jVE7+78V$3W@Z8:++^Dcx;ac=xb)Ip@!*FT7i=Y/y,Fl6574V}e]7cf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD', 'direct');