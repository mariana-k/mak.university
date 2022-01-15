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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'i7t0rr9m4iyIrHyQn8/dW1J1KPhflKgrPY9xFOPytaYOKUaeV1NHLDsvxNBXx6VXamCe4hoTzASQvpWCtjX7uA==');
define('SECURE_AUTH_KEY',  'DlXdMizIkORvwpjOf+1yFNlkUe7HrKLHpz++ldimQPkk/NLHmg3/+HAN8Hfim8IG/widtRgYba0Dr84UdcxccA==');
define('LOGGED_IN_KEY',    'iuNarS0qUpq/xwRPVPLcW5gFKYKTadGXISeG5unFXlmSN6kCSRGcFCivCvHfKA2nDDrixCKm8InN7rT5YDtXHg==');
define('NONCE_KEY',        'fkVszOa1Y+Cks8RTCQEuLWc7E9EKSQwwXBCJ+up9VvYSuheTspkoYe2zzh4wG9D90BBn9c5hmdKwGnWqAntehQ==');
define('AUTH_SALT',        '2txWQ0B5dHuhCHBWVuhnK5RxoWxQJVy4SbLMgpRvn3NEBsouqArQX4VJjB7/S50tHQT0RIohWHm2WNeD7cGxOg==');
define('SECURE_AUTH_SALT', 'ncrqb1ClHErnXBtbQFCJpsB/wwjlnir6bWjHBVE9EPN0OULjmTdO8/2EBpuKHGQ9JCFc61uAUrlUfi7KPdFzLQ==');
define('LOGGED_IN_SALT',   'L+sL+ZBWHsFdo41FLqnw6LJ/kcUvy1pKBHs+EWZaq7IZ0GWSEJ48rVFOZ/gExcBigNDPRAg84ubkm68TdjPZlw==');
define('NONCE_SALT',       'wy5VO/Qcn3UD1oNu3KgNQoS/jHyEqtNxqF8eWKsEJPVVq6icrfT1zhAxAyLBkcgyY23w2l44RG33NlSOP0bwOw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
