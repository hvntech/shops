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
define('DB_NAME', 'myshop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'F0Zl2FE$YFom![:T0d>P-b5]BPa:0|QVr#s3!S;woM06Eg[X,|xJ);.;|-huKec|');
define('SECURE_AUTH_KEY',  '.rmx{^jNx)X4Z0 Q-!_t37i2m>H63wm6Ua@N3W>WwZLJ]Y&ul.vQh?UBx)_K%ZCO');
define('LOGGED_IN_KEY',    '2d{imPSq)FYbMXOFEQ=XGz+o {Zc#HIjpl~)M<jz>: 22d2i,z@,(7uh/{dBpbg6');
define('NONCE_KEY',        'T/N`C9C?oI<cf*dTL%:s~`T|SSb!B)(`TPu9_Z<=|7DV6X6>Yk<m4J=Z8F;K{k9:');
define('AUTH_SALT',        '1H{J:37V)=fJKI6HK7$j+ tI|~ +q:qvFAVfW^%GBp$VU|dNC!94)H},GK~N7YNx');
define('SECURE_AUTH_SALT', '% ;!C_-^2P_t:J]3GZ {D]si`TvYxtEN(.d.LyV7Tp0=g:gY2Lyla:DYD$fP`,3l');
define('LOGGED_IN_SALT',   '3 /qj3.t9HJ279.)G(O!yD}33- xUXd=TWBfr=+6I>mDUxA!j9BN^Vt$-3*VL 9R');
define('NONCE_SALT',       'yHrQ$Kw_wh2@DM*Yv|GNWq/h*w}/[di/YZX$`f/52DaNGSH[trd`4<f>.v.z0%Nb');

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
