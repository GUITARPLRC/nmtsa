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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:8889');

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
define('AUTH_KEY',         'uhx=6fs{:;]*P|2~Ws7)X#Vzcxa!e0*w:m0BVo@_MWrdqTQty97Kk#L27<&(2<|U');
define('SECURE_AUTH_KEY',  'p^C8I]`3Ru#*8r=|D5u@a17n|IrwpH<uW:i7<3t^,zM.@md(~lxFtblNhqkvm!dq');
define('LOGGED_IN_KEY',    'KVQs7PG{]msXzJSv7O(I7fGG6bjLuy3X5iPT+f+<Zf:y~s6F/*@n,3lsNeW$[2Dr');
define('NONCE_KEY',        'Y9s>Oy(.bnUuwTu;,`S7U`jhj_w>4Fym6lHBz~^h2}HyoR,<y-]xA[litT}H.ENO');
define('AUTH_SALT',        ']UoR<EHmx++@,ZSXr Au,NB^6X#9*[)MtYn%F3 MOj&*5raTDL;ht>YateeAIKi;');
define('SECURE_AUTH_SALT', 'CP}$)|OUsg(OrYD}a]awSBz|,~3|GRv`Ap6KlgB]@]YjQg*Z/.K;Uz1riHA@X*^@');
define('LOGGED_IN_SALT',   'P-|O]*oH_ZSh33ix6xxQKhv+v<{dz$f&Q>f`}dC5fj_=Z`Eoo^%DFE7pv1hd<io|');
define('NONCE_SALT',       '@nh9h;VO@tNpWE: Ay3PrkZ(;!6;62<N,9h~NqF8]GXcE/SL6rxwxPpYQjjk<:w1');

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
