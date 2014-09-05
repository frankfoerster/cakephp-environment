<?php

class AllEnvironmentTestsTest extends PHPUnit_Framework_TestSuite {

	/**
	 * Defines all tests for this suite.
	 *
	 * @return CakeTestSuite
	 */
	public static function suite() {
		$suite = new CakeTestSuite('All Environment Tests');

		$path = dirname(__FILE__) . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}

}
