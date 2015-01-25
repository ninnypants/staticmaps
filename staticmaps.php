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

/**
 * @package StaticMaps
 */

$STATICMAPS_ABSPATH = plugin_dir_path( __FILE__ );

require_once $STATICMAPS_ABSPATH . '/includes/class-staticmaps.php';

$static_maps = new StaticMaps;
