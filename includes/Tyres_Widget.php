<?php
defined( 'ABSPATH' ) || exit; //exit of accessed directly
class Tyres_Widget extends WP_Widget {
	protected $sizes_tax;
	protected $height_tax;
	protected $profiles_tax;
	protected $hide_empty = false;

	function __construct() {
		parent::__construct( 'wc_tyres', __( 'Search for tyres', 'tyres' ), array( 'description' => __( 'Tyres advanced search form', 'tyres' ), ) );
		$this->sizes_tax    = 'tyre_size';
		$this->height_tax   = 'tyre_height';
		$this->profiles_tax = 'tyre_profile';
	}

	/**
	 * Widget Front-End
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$profiles = $this->get_profiles();
		$heights  = $this->get_heights();
		$sizes    = $this->get_sizes();
		?>
        <div class="tyres-search-form">
            <form action="<?php echo home_url(); ?>" method="get">
                <div class="tyre_input_container">
                    <label for="tyres_profile">
						<?php esc_html_e( 'Search for:', 'tyre' ); ?>
                    </label>
                    <input type="text" name="s" placeholder="<?php esc_attr_e( 'Search for products', 'tyre' ); ?>">
                </div>
                <div class="tyre_profiles_container tyre_input_container">
                    <label for="tyres_profile">
						<?php esc_html_e( 'Tyre Profile', 'tyre' ); ?>
                    </label>
                    <select name="tyres_profile" id="tyres_profile">
                        <option value=""><?php esc_html_e( 'All', 'tyres' ); ?></option>
						<?php if ( $profiles ) {
							foreach ( $profiles as $profile ) {
								?>
                                <option value="<?php echo esc_attr( $profile->slug ) ?>"><?php echo esc_html( $profile->name ) ?></option>
								<?php
							}
						} ?>
                    </select>
                </div>
                <div class="tyres_heights_container tyre_input_container">
                    <label for="tyres_heights">
						<?php esc_html_e( 'Tyre Height', 'tyre' ); ?>
                    </label>
                    <select name="tyres_heights" id="tyres_heights">
                        <option value=""><?php esc_html_e( 'All', 'tyres' ); ?></option>
						<?php if ( $heights ) {
							foreach ( $heights as $height ) {
								?>
                                <option value="<?php echo esc_attr( $height->slug ) ?>"><?php echo esc_html( $height->name ) ?></option>
								<?php
							}
						} ?>
                    </select>
                </div>
                <div class="tyres_size_container tyre_input_container">
                    <label for="tyres_size">
						<?php esc_html_e( 'Tyre Size', 'tyre' ); ?>
                    </label>
                    <select name="tyres_size" id="tyres_size">
                        <option value=""><?php esc_html_e( 'All', 'tyres' ); ?></option>
						<?php if ( $sizes ) {
							foreach ( $sizes as $size ) {
								?>
                                <option value="<?php echo esc_attr( $size->slug ) ?>"><?php echo esc_html( $size->name ) ?></option>
								<?php
							}
						} ?>
                    </select>
                </div>
                <input type="hidden" name="post_type" value="product">
                <button type="submit">Search</button>
            </form>
        </div>
		<?php

		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}
		// Widget admin form
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	private function get_profiles() {
		return get_terms( $this->profiles_tax, array(
			'hide_empty' => $this->hide_empty,
		) );
	}

	private function get_heights() {
		return get_terms( $this->height_tax, array(
			'hide_empty' => $this->hide_empty,
		) );
	}

	private function get_sizes() {
		return get_terms( $this->sizes_tax, array(
			'hide_empty' => $this->hide_empty,
		) );
	}
}