<?php
/**
 * @package StaticMaps
 */
class StaticMaps {
	protected $base_url = 'https://maps.googleapis.com/maps/api/staticmap';
	protected $defaults = array(
		'center' => 'Provo, UT',
		'zoom' => 12,
		'width' => 500,
		'height' => 400,
		// 'size' => '500x400',
		'scale' => 1,
		'format' => 'PNG',
		'maptype' => 'roadmap',
		// 'language' => '',
		// 'region' => '',
	);

	public function __construct() {
		add_shortcode( 'map', array( $this, 'shortcode_map' ) );
		add_shortcode( 'marker', array( $this, 'shortcode_marker' ) );
		add_shortcode( 'location', array( $this, 'shortcode_location' ) );
	}

	public function shortcode_map( $atts, $content, $tag ) {
		$args = wp_parse_args( $atts, $this->defaults );

		$output_url = $this->base_url;

	}

	public function shortcode_marker( $atts, $content, $tag ) {

	}

	public function shortcode_location( $atts, $content, $tag ) {

	}

	/**
	 * Do basic prep work for all params
	 *
	 * @param  mixed $value Param to be preped for use
	 * @return mixed Processed param ready to be used
	 */
	public function prep_param( $value ) {
		return trim( $value );
	}

	/**
	 * Make sure the zoom param is an integer, and within the range
	 * of 0 to 22
	 *
	 * @param  int $value Zoom level to be used for the map
	 * @return int A valid zoom level to be used
	 */
	public function prep_zoom( $value ) {
		$zoom = $this->prep_param( $value );

		if ( ! is_numeric( $zoom ) ) {
			return $this->defaults['zoom'];
		}

		// make sure $zoom is actually an int
		$zoom = (int) $zoom;

		if ( $zoom < 0 ) {
			$zoom = 0;
		} elseif ( 22 < $zoom ) {
			$zoom = 22;
		}

		return $zoom;
	}
}
