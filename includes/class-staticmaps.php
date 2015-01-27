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
		'format' => 'png',
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

	public function prep_format( $value ) {
		$format = strtolower( $value );

		if ( ! in_array( $format, array( 'png8', 'png', 'png32', 'gif', 'jpg', 'jpg-baseline', ) ) ) {
			return $this->defaults['format'];
		}

		return $format;
	}

	public function prep_width( $value ) {
		$width = (int) $value;

		if ( empty( $width ) ) {
			$width = $this->defaults['width'];
		}

		if ( 640 < $width ) {
			$width = 640;
		}

		return $width;
	}

	public function prep_height( $value ) {
		$height = (int) $value;

		if ( empty( $height ) ) {
			$height = $this->defaults['height'];
		}

		if ( 640 < $height ) {
			$height = 640;
		}

		return $height;
	}

	public function prep_scale( $value ) {
		$scale = (int) $value;

		if ( empty( $scale ) || ! in_array( $scale, array( 1, 2 ) ) ) {
			$scale = $this->defaults['scale'];
		}

		return $scale;
	}

	public function prep_maptype( $maptype ) {
		if ( ! in_array( $maptype, array( 'roadmap','satellite','terrain','hybrid' ) ) ) {
			$maptype = $this->defaults['maptype'];
		}
		return $maptype;
	}
}
