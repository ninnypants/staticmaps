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
		$this->markTestIncomplete();
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
