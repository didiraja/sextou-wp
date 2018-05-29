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
define('DB_NAME', 'eventos');

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
define('AUTH_KEY',         '`. K:=-WEm}~nmOep2Jh#.$M>*BG#0t.+r8!2+RE#dA2:](cap:D&)O,gvA ~MO%');
define('SECURE_AUTH_KEY',  '^9}{k#w2 .>p8nc@(r{8m]ww(unzLUrEbytSM.hM/$u`R92lw%.&T;bR/9?cI*DR');
define('LOGGED_IN_KEY',    'b3vS,(T&J|*djc`,Tsjh/vGnP`X`|[&H~M^Yx{UUbhyw}Knu{($WR#$!@V7yK*`J');
define('NONCE_KEY',        'Q1yh._OeayPK#su>NfWQ]Xcy<V4bO$SwURTyaW?/U}%G,+!^+4,d4RV$`n(H:1Bx');
define('AUTH_SALT',        'jX&MOz{Rz ,qIbonGY0~~2e4E/fRV}sxnRPhunrn!O7Wm_On{-a-eVKV6x{MjD{2');
define('SECURE_AUTH_SALT', 'E7}{V!HP-2tDv0;=rkoMV_SY@EpX}gDf=F !p_SZYQ&M0d8tj 3yEC@uTL[YhR m');
define('LOGGED_IN_SALT',   '$Y&awRfc[Oe$x+82rBK! @JMa%z4UJ3,O6:[ LiD,6P,oDx}Gj:E?8}*;ffcglr]');
define('NONCE_SALT',       '06I})eDo(NHN0ic&bXo4]Q{sPwKGh))RX#O9o]W@SEIu.Vx&`#iV>E[i?2cbh]$3');

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
