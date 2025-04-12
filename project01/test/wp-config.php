<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'MySQL-5.7' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '_Xq^+ji(lr#-=v=_avljY[qA}ZD$U-D)ak<,Xu/L9k:;UkCEdJN8LcF3N E*VaIl' );
define( 'SECURE_AUTH_KEY',  '|VF]U] S?^O(%*T-0CY|GAhAHm848@,`$kv4>)!G(T2}J3?gVA(qxvrwr]RoQR8(' );
define( 'LOGGED_IN_KEY',    'f+f=wE$~(DLh(D@HX9B](>ZU:T(>MaEV[BDdNbCf5qQk,^9J/B0?ccPHj{`w-[#=' );
define( 'NONCE_KEY',        'A126_S)|W}GND|(5aq)[*vT+MPjCEcR>+J6oi6H4,m^@dWN&fjwD/R.5rCJGCCAf' );
define( 'AUTH_SALT',        '2~fw3v)}w0YTHIRR 2#(G?k_Io8HS^vLvl{tn7*0J[J96BBPcA_v3CO=4}bQIeo-' );
define( 'SECURE_AUTH_SALT', 'Rv=28#u:V7?>QEc?3t{&Kce`5pqj*6R!{z(&HydBSz,;~},>uE/wG_TbC9Ll[>Oh' );
define( 'LOGGED_IN_SALT',   'N)(46>T4tSW(5G}q4W,Vsh>abv/VXl]OIEN.mw8l]NNdm] JQEo{H9PsEeNPxSjC' );
define( 'NONCE_SALT',       'Z&iGl%`*- NL26~O`=b&4Yz2RYM($v=7H0u4V]bGefSW,_7$Er5wRWbs^]E9t@`P' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */


define('WP_HOME','http://test');
define('WP_SITEURL','http://test');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
