<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nguyenquang_cnpm' );

/** Database username */
define( 'DB_USER', 'nguyenquang_cnpm' );

/** Database password */
define( 'DB_PASSWORD', 'VO8CxK)U8=q7' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'Nq3Z9;@$Ke`#d;Pfw[R/&.@3E>KuJTrz>K9[oh##VsEK=(!6|Vh{!FF0M3_7){AG' );
define( 'SECURE_AUTH_KEY',  'kv/DAfKa54DU|e#6k{CC=UZ#A@m!f*:=9zJ/whe<}@$%bU]_82gq6,Z=;+*q2YeM' );
define( 'LOGGED_IN_KEY',    'PD+!Fuz8SYzt.1PpJ2OI!uw`Hg7fTpyEO}dl,&B<)kgg$5 0kh38G,Xqz]wA18oI' );
define( 'NONCE_KEY',        'B<b4PYP*@RV^9(VRSXDi4a>mX_~x1B:gJ,RIXRL!lUEq^]PR57Qq}Y%@#p;!%/u`' );
define( 'AUTH_SALT',        'ka7OHvezZA.8OZT#omQp8SwOQ@q>EQQ9n_6`QQ>{:eM&RV/lq^HnR0hu|~+{?|xt' );
define( 'SECURE_AUTH_SALT', 'j@d/O9.DdnRYIW?h3q.J-ks*#5![t1P_uY&;-+$5AvG~lSJ)E4Cyu2UYO9_</P@ ' );
define( 'LOGGED_IN_SALT',   '4rv2LnSt-fZDv+/QZyGChw?m8<?c#uDC+zJ5? <k!<e[2>5TK -4!wEW$UJRfX@d' );
define( 'NONCE_SALT',       'O#Q=}Eo/%Z5K9Nn{@_jmt@~c5 s7=ghm+;q62h_MMSo!M8~OfnbOIIxbt4Cv%e!N' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
