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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'msgamego');

/** MySQL database username */
//define( 'DB_USER', 'msgamego' );
define('DB_USER', 'root');

/** MySQL database password */
//define( 'DB_PASSWORD', 'hciFyyn3SGHyeri3' );
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY', '>[%]P`$92>` S(p~iCVHX(R0x.d =?H7bbz;vI`{V1]IeY8Eoomb-=e;4kC{O<m0');
define('SECURE_AUTH_KEY', 'ATxMBV^]aG2>Q4yUqY#3:LEg4~`sn+=`t.CPO[x5ggM.B@dm ,,vT^?[|acr*,Md');
define('LOGGED_IN_KEY', '/*(5rO?,h) #,R7;VYq5<DFyHP%>Ot_p5Zhyr]@~u{i-0y,}7ng4wsR8qK6-pYWT');
define('NONCE_KEY', 'rd*QMh;l%38Vq]/Dh{x~vJ:P.b_7ZGf7&tk8;/J#=HFZ+&m=Va-l29eCw|[zQq0{');
define('AUTH_SALT', 's6Y#v!Jaw@7w&< +p)D-4&1TP0z]EvG7Qon:ep+|/#2ryQ^`MVxFd9A.L-?ca3g4');
define('SECURE_AUTH_SALT', '-}JKsMAlii}H`|KH1/;B J#;oLz$|7J)p&PhO*m%{~G:xc_.cFz|T5-u(/gqr-u^');
define('LOGGED_IN_SALT', 'tV5f@!CEw=+E[A/9<L_1;1v)Je1W&!+<WA#9H<,}%zjPw<Jl=!|?P!g$t!C,EXIx');
define('NONCE_SALT', 'LFU;D#+Y-g@;{.^,7H6I|+Q#3+O>{x%,?dOu:zpf8q!~`m76/ltSx$P0S;v?230n');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
