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
}
