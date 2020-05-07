<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/devwael
 * @since      1.0.0
 *
 * @package    Tyres
 * @subpackage Tyres/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tyres
 * @subpackage Tyres/public
 * @author     Ahmad Wael <dev.ahmedwael@gmail.com>
 */
class Tyres_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tyres_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tyres_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tyres-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tyres_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tyres_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tyres-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Filter woocommerce search query to support tyres custom taxonomies
	 * @param $query
	 *
	 * @return mixed
	 */
	public function search_filter( $query ) {
		if ( ! isset( $_GET['post_type'] ) or ! isset( $_GET['tyres_heights'] ) or ! isset( $_GET['tyres_size'] ) or ! isset( $_GET['tyres_profile'] ) ) {
			return $query;
		}
		$post_type = $_GET['post_type'];
		if ( $post_type != 'product' or ! $query->is_search ) {
			return $query;
		}
		$n         = 0;
		$tax_query = array();
		if ( ! empty( $_GET['tyres_heights'] ) ) {
			$tax_query[] = array(
				'taxonomy' => 'tyre_height',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['tyres_heights'] ),
			);
			$n ++;
		}

		if ( ! empty( $_GET['tyres_size'] ) ) {
			$tax_query[] = array(
				'taxonomy' => 'tyre_size',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['tyres_size'] ),
			);
			$n ++;
		}

		if ( ! empty( $_GET['tyres_profile'] ) ) {
			$tax_query[] = array(
				'taxonomy' => 'tyre_profile',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['tyres_profile'] ),
			);
			$n ++;
		}

		if ( $n > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		if ( $n > 0 ) {
			$query->set( 'tax_query', $tax_query );
		}

		return $query;
	}
}
