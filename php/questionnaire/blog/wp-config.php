<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'my_blog');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'Jz2KfE3F2Qd8JMbA');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
/*
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');
 */
define('AUTH_KEY',         'nc-SU*NR@s;x_HAdGh:2K<ll,]YSXN*PdWNo||>~mGO!*@.c*](W8ByeW;|zk(8O');
define('SECURE_AUTH_KEY',  'i5$okxdb~QvPTIJj8A*B=FBWR8rLw{YY%+h.s*xv)N^ln-~t2U[,|hlFh|DYL@]L');
define('LOGGED_IN_KEY',    'GVZ(/gUdFmH%_e$YKmxAP,$Y;-<8HCn+fyNm}2sLV];o.TljSe+z+<k$}p-!>t:q');
define('NONCE_KEY',        '?I]7xAMcHY17bfL[>KxN|i`Be@vD{}}[+sD+e~QZ~>w+ yh5I[WC78PO^zNRWEGu');
define('AUTH_SALT',        'rcP-KzdL<{ W_AU&+Ls-zv>180E.i6d8dZPw<8-m.t|K]yY(J)SG/-XB,-2/mYf_');
define('SECURE_AUTH_SALT', 'Ke|+vp|H@v*0`J4/c[Y=&e4o0H8F+IKxanrHef32+a~|i$?u[*rD[24NNK`fJWGW');
define('LOGGED_IN_SALT',   '[8}egB&;: [_s-+ij-R^ZKz~Wm%LJO%OvWu#!Hlu4Hs8],dE|+<g!2$9kar*%yf]');
define('NONCE_SALT',       ')McL9|*GGspKB3NJFV53?{:yHr9r5p|H-NxuMW>o-PIzJQZnPYr^CZ7!3>[pmc<d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
