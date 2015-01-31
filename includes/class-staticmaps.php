<?php
/**
 * @package StaticMaps
 */
class StaticMaps {
	/**
	 * Base static map url
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $base_url = 'https://maps.googleapis.com/maps/api/staticmap';

	/**
	 * Defaults to be used for any required vaues that aren't passed to the
	 * shortcode
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $defaults = array(
		'center' => 'Provo, UT',
		'zoom' => 12,
		'width' => 500,
		'height' => 400,
		'scale' => 1,
		'format' => 'png',
		'maptype' => 'roadmap',
		// 'language' => '',
		// 'region' => '',
	);

	/**
	 * Register shortcodes
	 */
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
	 * Validates zoom parameter
	 *
	 * This can either be passed an integer between 0 and 22, or the string implicit.
	 * If passed a number it will make sure it's within the bounds of 0 to 22. If lower
	 * than the bounds it will return 0, and if higher it will return 22. If passed the
	 * string implicit it will return nothing triggering the use of Google's implicit
	 * zoom.{@link https://developers.google.com/maps/documentation/staticmaps/index#ImplicitPositioning}
	 *
	 * If neither a number nor the string implicit is passed it will return the default.
	 *
	 * @param  int $value Required. Zoom level to be used for the map
	 * @return int A valid zoom level to be used
	 */
	public function prep_zoom( $value ) {
		$zoom = $this->prep_param( $value );

		if ( 'implicit' === $zoom ) {
			return;
		}

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

	/**
	 * Make sure that the format is one of the allowed types.
	 *
	 * - png8 or png (default) specifies the 8-bit PNG format.
	 * - png32 specifies the 32-bit PNG format.
	 * - gif specifies the GIF format.
	 * - jpg specifies the JPEG compression format.
	 * - jpg-baseline specifies a non-progressive JPEG compression format.
	 *
	 * @since 0.1.0
	 *
	 * @param  string $value Format returned image should be in
	 * @return string One of the predefined formats or the default format
	 */
	public function prep_format( $value ) {
		$format = strtolower( $value );

		if ( ! in_array( $format, array( 'png8', 'png', 'png32', 'gif', 'jpg', 'jpg-baseline', ) ) ) {
			return $this->defaults['format'];
		}

		return $format;
	}

	/**
	 * Make sure the width is a valid number and less than 640px
	 *
	 * @since 0.1.0
	 * @todo Setup support for 4x image once api keys are handled
	 *
	 * @param  int $value Image width to be validated
	 * @return int Validated image height
	 */
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

	/**
	 * Make sure the height is a valid number and less than 640px
	 *
	 * @since 0.1.0
	 * @todo Setup support for 4x image once api keys are handled
	 *
	 * @param  int $value Image height to be validated
	 * @return int Validated image height
	 */
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

	/**
	 * Make sure the scale value is valid. Currently it can be 1 or 2. 4 is supported
	 * with an API key.
	 *
	 * @since 0.1.0
	 * @todo Add support for 4 once api key handling is added
	 *
	 * @param  int $value Integer specifying the desired image scale
	 * @return int An allowable scale value 1x, 2x, or eventually 4x
	 */
	public function prep_scale( $value ) {
		$scale = (int) $value;

		if ( empty( $scale ) || ! in_array( $scale, array( 1, 2 ) ) ) {
			$scale = $this->defaults['scale'];
		}

		return $scale;
	}

	/**
	 * Filter maptype attribute and make sure it's an allowed type, or use the default if not.
	 *
	 * Allowed types:
	 * - roadmap (default) specifies a standard roadmap image, as is normally shown on the Google Maps website.
	 * - satellite specifies a satellite image.
	 * - terrain specifies a physical relief map image, showing terrain and vegetation.
	 * - hybrid specifies a hybrid of the satellite and roadmap image, showing a transparent layer of major streets
	 *   and place names on the satellite image.
	 *
	 * @since 0.1.0
	 *
	 * @param  string $maptype Type of map to be displayed
	 * @return string Validated map type or a default
	 */
	public function prep_maptype( $maptype ) {
		if ( ! in_array( $maptype, array( 'roadmap', 'satellite', 'terrain', 'hybrid' ) ) ) {
			$maptype = $this->defaults['maptype'];
		}
		return $maptype;
	}
}
