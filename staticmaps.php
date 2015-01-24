<?php
/*
Plugin Name: Static Maps
Plugin URI: http://ninnypants.com
Description: Google static map image generator
Version: 1.0
Author: ninnypants
Author URI: http://ninnypants.com
License: GPL2

Copyright 2014  Tyrel Kelsey  (email : tyrel@ninnypants.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Softwar
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$static_maps = new StaticMaps;
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