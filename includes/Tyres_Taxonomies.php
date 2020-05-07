<?php
defined( 'ABSPATH' ) || exit; //exit of accessed directly
class Tyres_Taxonomies {

	protected $plugin_name;
	protected $version;
	protected $product_post_type = 'product';

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	public function tyre_height() {
		$labels = array(
			'name'          => _x( 'Heights', 'taxonomy general name', 'tyre' ),
			'singular_name' => _x( 'Height', 'taxonomy singular name', 'tyre' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'tyre_height', array( $this->product_post_type ), $args );
	}

	public function tyre_profile() {
		$labels = array(
			'name'          => _x( 'Profiles', 'taxonomy general name', 'textdomain' ),
			'singular_name' => _x( 'Profile', 'taxonomy singular name', 'textdomain' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'tyre_profile', array( $this->product_post_type ), $args );
	}

	public function tyre_size() {
		$labels = array(
			'name'          => _x( 'Sizes', 'taxonomy general name', 'textdomain' ),
			'singular_name' => _x( 'size', 'taxonomy singular name', 'textdomain' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'tyre_size', array( $this->product_post_type ), $args );
	}

}