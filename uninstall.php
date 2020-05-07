<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://github.com/devwael
 * @since      1.0.0
 *
 * @package    Tyres
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * cleaning database and delete all taxonomy terms
 */
$tyre_height = get_terms( 'tyre_height', array( 'fields' => 'ids', 'hide_empty' => false ) );
if ( $tyre_height ) {
	foreach ( $tyre_height as $value ) {
		wp_delete_term( $value, 'tyre_height' );
	}
}

$tyre_profile = get_terms( 'tyre_profile', array( 'fields' => 'ids', 'hide_empty' => false ) );
if ( $tyre_profile ) {
	foreach ( $tyre_profile as $value ) {
		wp_delete_term( $value, 'tyre_profile' );
	}
}

$tyre_size = get_terms( 'tyre_size', array( 'fields' => 'ids', 'hide_empty' => false ) );
if ( $tyre_size ) {
	foreach ( $tyre_size as $value ) {
		wp_delete_term( $value, 'tyre_size' );
	}
}