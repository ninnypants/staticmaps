<?php
/**
 * @package StaticMaps
 */
class StaticMaps {
	protected $base_url = 'https://maps.googleapis.com/maps/api/staticmap';

	public function __construct() {
		add_shortcode( 'map', array( $this, 'shortcode_map' ) );
		add_shortcode( 'marker', array( $this, 'shortcode_marker' ) );
		add_shortcode( 'location', array( $this, 'shortcode_location' ) );
	}

	public function shortcode_map( $atts, $content, $tag ) {
		$args = wp_parse_args( $atts, array(
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
		) );

		$output_url = $this->base_url;

	}

	public function shortcode_marker( $atts, $content, $tag ) {

	}

	public function shortcode_location( $atts, $content, $tag ) {

	}

	public function prep_param( $value ) {
		return trim( $value );
	}

	public function prep_zoom( $value ) {
		$center = $this->prep_param( $value );
		$center = (int) $center;

		if ( $zoom < 0 ) {
			$zoom = 0;
		} elseif ( 22 < $zoom ) {
			$zoom = 22;
		}

		return $zoom;
	}
}
