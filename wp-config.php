<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'splantr');

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
define('AUTH_KEY',         'P&tQ7QT7+b90:X-~(BoFE|V#V&^<=U2m+[nK+I|M}?wP?2pr3lNBmxs70,ye@F5k');
define('SECURE_AUTH_KEY',  'D6W*%jGz51r< a+c`OvR:sX1gB&tH{[)09]$mEuXi1NmA=9 E}M-p71u3y.V1=~E');
define('LOGGED_IN_KEY',    'q[mZN-@u.vu!ZNI+>!oQ@RW(T[XCUnKVwoW8W%Gj(2-<55mqVXx@O{fr{|T/!]HN');
define('NONCE_KEY',        '[!JL5hYW|EL)LBE:>DLeOJI7@|8|<@Y[qa]j]vlv16VK6wlmPFI`Ew|J`U_(:(Mo');
define('AUTH_SALT',        'I9S=jkk7;&VJR+|l>aG#N[[1cy:D[{|(2uq|v}`:$:1{`S,z-xB +0Ly|o<z=)!C');
define('SECURE_AUTH_SALT', '0-.bWCH/lc{E=~%dTFhl{%oXAu;C|>X27phSVc,be=QjF*+rFK_Q>SNex .|OQxQ');
define('LOGGED_IN_SALT',   '<SO(:SD#RI>AzH5_SN@oxvIS#zChE$#EEqqOl^ V=vOCg+x+FLE9jhJe7q%cr?@I');
define('NONCE_SALT',       'Y;)G11+OZ74]>?%R8wc)<G@}-~-x8G<c!AbSE}WLT-|r-Jx<9~pDOl{k$Cz,|)nF');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '0525_splantr_';

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
