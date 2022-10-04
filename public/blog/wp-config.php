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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bookpointwpdb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'Aa--&(O%YLxTv^3/Oc6@`;4S~, /1ypAAAwnnS:ug,%`(jHR3^6%W~6uv4s@D^x,' );
define( 'SECURE_AUTH_KEY',  '2jbcgYu(r}o[r>i`OBOKALIH@L|T.vt]C{~X.AaW!MWf,qCn&T;,gX`#=A5n`t3u' );
define( 'LOGGED_IN_KEY',    'w>l2v*mNVoiQ.okNk-Jv]pm!8%vK7UK,{Kvq3,--]@e_tfQe0OJR23>|or>Q ZH}' );
define( 'NONCE_KEY',        '0-9:Yt_$(7tvrRzSE*a~Dmo>dz=YxDyPpb%}`[B&aUYB#;,%wWfX/h.@;w{@R/B4' );
define( 'AUTH_SALT',        'sV#5u@85AhI{&i7z_bMvRkMZ|W.R5Z#nugEeC 3l-3*UY1$2%T1E(rggj>o5>s`s' );
define( 'SECURE_AUTH_SALT', '/LRMmF>9_XUWztg~HH}y1Xw_/lRbYp@hWL_|GL1~ em4d$d9j.z&BA!U >4HUI;o' );
define( 'LOGGED_IN_SALT',   'oRn8.EFoa0&@D^,BgY) []>n;uvy0MkAdslO{,Lf*}O%o(Ll7|Q?wO>&Ag6@u9]Z' );
define( 'NONCE_SALT',       'c8~mGLf47yAbuWmOn~.lgX6?HK$i=}[cv?Cy*UW>ng*O>lM}yt!{(U5^|q,~@RVi' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_bookpoint147';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
