<?php

class StaticMaps_Tests extends PHPUnit_Framework_TestCase {
	public static $instance;

	public static function setUpBeforeClass() {
		\WP_Mock::setUp();
		\WP_Mock::wpFunction( 'add_shortcode', array(
			'times' => 3,
		));
		self::$instance = new StaticMaps;
		\WP_Mock::tearDown();
	}

	public static function tearDownAfterClass() {
		self::$instance = null;
	}

	public function setUp() {
		\WP_Mock::setUp();
	}

	public function tearDown() {
		\WP_Mock::tearDown();
	}

	public function test_prep_param() {
		$this->assertEmpty( self::$instance->prep_param( ' ' ) );
		$this->assertEquals( 'param', self::$instance->prep_param( 'param ' ) );
		$this->assertEquals( 'param', self::$instance->prep_param( ' param' ) );
		$this->assertEquals( 'param', self::$instance->prep_param( ' param ' ) );
	}

	public function test_prep_zoom() {
		// make sure everything stays within bounds
		$this->assertEquals( 0, self::$instance->prep_zoom( -1 ) );
		$this->assertEquals( 22, self::$instance->prep_zoom( 300 ) );

		// test proper value
		$this->assertEquals( 10, self::$instance->prep_zoom( 10 ) );

		// make sure we get a default if we don't pass an int
		$this->assertEquals( 12, self::$instance->prep_zoom( 'zoom' ) );

		$this->assertEmpty( self::$instance->prep_zoom( 'implicit' ) );
	}

	public function test_prep_format() {
		// make sure we get a format back even if we pass and empty string
		$this->assertEquals( 'png', self::$instance->prep_format( '' ) );

		// test to make sure that an outside string gets a default of png
		$this->assertEquals( 'png', self::$instance->prep_format( 'format' ) );

		// make sure that uppercase and mixed case strings work
		$this->assertEquals( 'png', self::$instance->prep_format( 'PNG' ) );
		$this->assertEquals( 'png', self::$instance->prep_format( 'pNG' ) );

		// test all available fomats to see if we get them back
		$this->assertEquals( 'png8', self::$instance->prep_format( 'png8' ) );
		$this->assertEquals( 'png', self::$instance->prep_format( 'png' ) );
		$this->assertEquals( 'png32', self::$instance->prep_format( 'png32' ) );
		$this->assertEquals( 'gif', self::$instance->prep_format( 'gif' ) );
		$this->assertEquals( 'jpg', self::$instance->prep_format( 'jpg' ) );
		$this->assertEquals( 'jpg-baseline', self::$instance->prep_format( 'jpg-baseline' ) );
	}

	public function test_prep_width() {
		// make sure a default comes through
		$this->assertEquals( 500, self::$instance->prep_width( '' ) );
		// make sure it works with px widths
		$this->assertEquals( 640, self::$instance->prep_width( '640px' ) );
		// and numeric
		$this->assertEquals( 100, self::$instance->prep_width( 100 ) );
		// drop width back to upper bounds
		$this->assertEquals( 640, self::$instance->prep_width( 3000 ) );
	}

	public function test_prep_height() {
		// make sure a default comes through
		$this->assertEquals( 400, self::$instance->prep_height( '' ) );
		// make sure it works with px heights
		$this->assertEquals( 640, self::$instance->prep_height( '640px' ) );
		// and numeric
		$this->assertEquals( 100, self::$instance->prep_height( 100 ) );
		// drop height back to upper bounds
		$this->assertEquals( 640, self::$instance->prep_height( 3000 ) );
	}

	public function test_prep_scale() {
		// make sure it'll fall back to default
		$this->assertEquals( 1, self::$instance->prep_scale( '' ) );
		// make sure it's one of the two possible values
		$this->assertEquals( 1, self::$instance->prep_scale( 3 ) );
		// make sure the two possible values work
		$this->assertEquals( 1, self::$instance->prep_scale( 1 ) );
		$this->assertEquals( 2, self::$instance->prep_scale( 2 ) );
	}

	public function test_prep_maptype() {
		// default
		$this->assertEquals( 'roadmap', self::$instance->prep_maptype( '' ) );
		// test all possible variations
		$this->assertEquals( 'roadmap', self::$instance->prep_maptype( 'roadmap' ) );
		$this->assertEquals( 'satellite', self::$instance->prep_maptype( 'satellite' ) );
		$this->assertEquals( 'terrain', self::$instance->prep_maptype( 'terrain' ) );
		$this->assertEquals( 'hybrid', self::$instance->prep_maptype( 'hybrid' ) );
	}

	public function test_shortcode_map() {
		// \WP_Mock::wpFunction( 'do_shortcode', array( 'times' => 1 ) );
		// \WP_Mock::wpFunction( 'wp_parse_args', array(
		// 	'times' => 1,
		// 	'return_in_order' => array(
		// 		array(
		// 			'center' => 'Provo, UT',
		// 			'zoom' => 12,
		// 			'width' => 500,
		// 			'height' => 400,
		// 			'scale' => 1,
		// 			'format' => 'png',
		// 			'maptype' => 'roadmap',
		// 			// 'language' => '',
		// 			// 'region' => '',
		// 		),
		// 	),
		// ) );

		// $this->assertEquals( '', );

		$this->markTestIncomplete();
	}

	public function test_prep_marker_color() {
		self::$instance->markers[] = array();
		self::$instance->current_marker = &self::$instance->markers[0];

		// test default
		self::$instance->prep_marker_color( '' );
		$this->assertEquals( 'red', self::$instance->current_marker['color'] );

		// test all static colors
		self::$instance->prep_marker_color( 'black' );
		$this->assertEquals( 'black', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'brown' );
		$this->assertEquals( 'brown', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'green' );
		$this->assertEquals( 'green', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'purple' );
		$this->assertEquals( 'purple', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'yellow' );
		$this->assertEquals( 'yellow', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'blue' );
		$this->assertEquals( 'blue', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'gray' );
		$this->assertEquals( 'gray', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'orange' );
		$this->assertEquals( 'orange', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'red' );
		$this->assertEquals( 'red', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'white' );
		$this->assertEquals( 'white', self::$instance->current_marker['color'] );

		self::$instance->prep_marker_color( '0x000000' );
		$this->assertEquals( '0x000000', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( '#ffffff' );
		$this->assertEquals( '0xffffff', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( '333333' );
		$this->assertEquals( '0x333333', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( '#f3c' );
		$this->assertEquals( '0xff33cc', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( 'c3f' );
		$this->assertEquals( '0xcc33ff', self::$instance->current_marker['color'] );
		self::$instance->prep_marker_color( '33333' );
		$this->assertEquals( 'red', self::$instance->current_marker['color'] );

		self::$instance->markers = array();
		unset( self::$instance->current_marker );
	}

	public function test_prep_marker_size() {
		self::$instance->markers[] = array();
		self::$instance->current_marker = &self::$instance->markers[0];

		// normal
		self::$instance->prep_marker_size( '' );
		$this->assertEquals( '',  self::$instance->current_marker['size'] );
		self::$instance->prep_marker_size( 'tiny' );
		$this->assertEquals( 'tiny',  self::$instance->current_marker['size'] );
		self::$instance->prep_marker_size( 'mid' );
		$this->assertEquals( 'mid',  self::$instance->current_marker['size'] );
		self::$instance->prep_marker_size( 'small' );
		$this->assertEquals( 'small',  self::$instance->current_marker['size'] );
		self::$instance->prep_marker_size( 'junk' );
		$this->assertEquals( '',  self::$instance->current_marker['size'] );

		self::$instance->markers = array();
		unset( self::$instance->current_marker );
	}

	public function test_prep_marker_label() {
		self::$instance->markers[] = array();
		self::$instance->current_marker = &self::$instance->markers[0];

		// allow empty
		self::$instance->prep_marker_label( '' );
		$this->assertEmpty( self::$instance->current_marker['label'] );
		// make sure it gets uppercased
		self::$instance->prep_marker_label( 'a' );
		$this->assertEquals( 'A', self::$instance->current_marker['label'] );
		// only allow A-Z 0-9
		self::$instance->prep_marker_label( '#' );
		$this->assertEmpty( self::$instance->current_marker['label'] );
		// numbers
		self::$instance->prep_marker_label( '9' );
		$this->assertEquals( '9', self::$instance->current_marker['label'] );
		// multiple characters
		self::$instance->prep_marker_label( 'A9' );
		$this->assertEquals( 'A', self::$instance->current_marker['label'] );

		self::$instance->markers = array();
		unset( self::$instance->current_marker );
	}

	public function test_shortcode_marker() {
		\WP_Mock::wpFunction( 'do_shortcode', array( 'times' => 2 ) );
		\WP_Mock::wpFunction( 'wp_parse_args', array(
			'times' => 2,
			'return_in_order' => array(
				array(
					'color' => '',
					'size' => '',
					'label' => '',
				),
				array(
					'color' => '#333',
					'size' => '',
					'label' => '',
				),
			),
		) );

		// defaults
		self::$instance->shortcode_marker( array(), '', 'marker' );
		$this->assertEquals( 'red', self::$instance->markers[0]['color'] );
		$this->assertEmpty( self::$instance->markers[0]['label'] );
		$this->assertEmpty( self::$instance->markers[0]['size'] );


		self::$instance->shortcode_marker( array( 'color' => '#333' ), '', 'marker' );
		$this->assertEquals( '0x333333', self::$instance->markers[1]['color'] );
		$this->assertEmpty( self::$instance->markers[1]['label'] );
		$this->assertEmpty( self::$instance->markers[1]['size'] );

		// empty markers
		self::$instance->markers = array();
		$this->markTestIncomplete();
	}

	public function test_shortcode_location() {
		// set up a fake marker and current marker
		self::$instance->markers[] = array( 'locations' => array() );
		self::$instance->current_marker = &self::$instance->markers[0];
		self::$instance->shortcode_location( array(), '40.2444,111.6608', 'location' );
		$this->assertEquals( array( 'locations' => array( '40.2444,111.6608' ) ), self::$instance->markers[0] );

		self::$instance->shortcode_location( array(), 'Orem, UT', 'location' );
		$this->assertEquals( array( 'locations' => array( '40.2444,111.6608', 'Orem, UT' ) ), self::$instance->markers[0] );

		self::$instance->shortcode_location( array(), '', 'location' );
		$this->assertEquals( array( 'locations' => array( '40.2444,111.6608', 'Orem, UT' ) ), self::$instance->markers[0] );

		// clean up
		self::$instance->markers = array();
		unset( self::$instance->current_marker );
	}
}
