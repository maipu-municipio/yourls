<?php
/**
 * Docker config for YOURLS: reads settings from environment variables.
 * Copied to user/config.php by docker/entrypoint.sh on container start.
 */

define( 'YOURLS_DB_USER', getenv( 'YOURLS_DB_USER' ) ?: '' );
define( 'YOURLS_DB_PASS', getenv( 'YOURLS_DB_PASS' ) ?: '' );
define( 'YOURLS_DB_NAME', getenv( 'YOURLS_DB_NAME' ) ?: 'yourls' );
define( 'YOURLS_DB_HOST', getenv( 'YOURLS_DB_HOST' ) ?: 'db' );
define( 'YOURLS_DB_PREFIX', getenv( 'YOURLS_DB_PREFIX' ) ?: 'yourls_' );

define( 'YOURLS_SITE', getenv( 'YOURLS_SITE' ) ?: '' );
define( 'YOURLS_LANG', getenv( 'YOURLS_LANG' ) ?: '' );

define( 'YOURLS_UNIQUE_URLS', filter_var( getenv( 'YOURLS_UNIQUE_URLS' ) ?: 'true', FILTER_VALIDATE_BOOLEAN ) );
define( 'YOURLS_PRIVATE', filter_var( getenv( 'YOURLS_PRIVATE' ) ?: 'true', FILTER_VALIDATE_BOOLEAN ) );

define( 'YOURLS_COOKIEKEY', getenv( 'YOURLS_COOKIEKEY' ) ?: '' );

/** Users are provisioned via YOURLS_USER_<n> / YOURLS_PASS_<n> env pairs (n = 1, 2, ...) */
$yourls_user_passwords = [];
for ( $i = 1; getenv( "YOURLS_USER_$i" ) !== false; $i++ ) {
    $yourls_user_passwords[ getenv( "YOURLS_USER_$i" ) ] = getenv( "YOURLS_PASS_$i" );
}

define( 'YOURLS_URL_CONVERT', (int) ( getenv( 'YOURLS_URL_CONVERT' ) ?: 36 ) );

define( 'YOURLS_DEBUG', filter_var( getenv( 'YOURLS_DEBUG' ) ?: 'false', FILTER_VALIDATE_BOOLEAN ) );

$yourls_reserved_URL = [
    'porn',
    'faggot',
    'sex',
    'nigger',
    'fuck',
    'cunt',
    'dick',
];
