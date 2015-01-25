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

	public function test_prep_scale() {
		$this->markTestIncomplete();
	}

	public function test_prep_maptype() {
		$this->markTestIncomplete();
	}

	public function test_shortcode_map() {
		$this->markTestIncomplete();
	}

	public function test_shortcode_marker() {
		$this->markTestIncomplete();
	}

	public function test_shortcode_location() {
		$this->markTestIncomplete();
	}
}
